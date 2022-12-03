<?php

namespace Modules\Coupon\Entities;

use Modules\Support\Money;
use Modules\Cart\Facades\Cart;
use Modules\User\Entities\User;
use Modules\Order\Entities\Order;
use Illuminate\Support\Facades\DB;
use Modules\Support\Eloquent\Model;
use Modules\Coupon\Admin\CouponTable;
use Modules\Product\Entities\Product;
use Modules\Category\Entities\Category;
use Modules\Support\Eloquent\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Coupon extends Model
{
    use Translatable,
        SoftDeletes,
        Concerns\SyncRelations,
        Concerns\RelationList;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['translations'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'is_percent',
        'value',
        'free_shipping',
        'start_date',
        'end_date',
        'is_active',
        'minimum_spend',
        'maximum_spend',
        'usage_limit_per_coupon',
        'usage_limit_per_customer',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'free_shipping' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['start_date', 'end_date', 'deleted_at'];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    protected $translatedAttributes = ['name'];

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    protected static function booted()
    {
        static::saved(function ($coupon) {
            $coupon->saveRelations(request()->all());
        });

        static::addActiveGlobalScope();
    }

    public static function findByCode($code)
    {
        return self::where(DB::raw('BINARY `code`'), $code)->first();
    }

    public function freeShipping()
    {
        return $this->free_shipping ? $this : (object) ['free_shipping' => 0];
    }

    public function valid()
    {
        if ($this->hasStartDate() && $this->hasEndDate()) {
            return $this->startDateIsValid() && $this->endDateIsValid();
        }

        if ($this->hasStartDate()) {
            return $this->startDateIsValid();
        }

        if ($this->hasEndDate()) {
            return $this->endDateIsValid();
        }

        return true;
    }

    public function invalid()
    {
        return ! $this->valid();
    }

    private function hasStartDate()
    {
        return ! is_null($this->start_date);
    }

    private function hasEndDate()
    {
        return ! is_null($this->end_date);
    }

    private function startDateIsValid()
    {
        return today() >= $this->start_date;
    }

    private function endDateIsValid()
    {
        return today() <= $this->end_date;
    }

    public function usageLimitReached($customerEmail = null)
    {
        return $this->perCouponUsageLimitReached() || $this->perCustomerUsageLimitReached($customerEmail);
    }

    public function perCouponUsageLimitReached()
    {
        if (is_null($this->usage_limit_per_coupon)) {
            return false;
        }

        return $this->used >= $this->usage_limit_per_coupon;
    }

    public function perCustomerUsageLimitReached($customerEmail = null)
    {
        if ($this->couponHasNoUsageLimitForCustomers() ||
            $this->userIsNotLoggedInWhenAddingCouponToCart($customerEmail)
        ) {
            return false;
        }

        $customerEmail = $customerEmail ?: auth()->user()->email;

        $used = $this->orders()
            ->where('customer_email', $customerEmail)
            ->count();

        return $used >= $this->usage_limit_per_customer;
    }

    private function couponHasNoUsageLimitForCustomers()
    {
        return is_null($this->usage_limit_per_customer);
    }

    private function userIsNotLoggedInWhenAddingCouponToCart($customerEmail = null)
    {
        return is_null($customerEmail) && auth()->guest();
    }

    public function didNotSpendTheRequiredAmount()
    {
        if (is_null($this->minimum_spend)) {
            return false;
        }

        return Cart::subTotal()->lessThan($this->minimum_spend);
    }

    public function spentMoreThanMaximumAmount()
    {
        if (is_null($this->maximum_spend)) {
            return false;
        }

        return Cart::subTotal()->greaterThan($this->maximum_spend);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'coupon_products')
            ->withPivot('exclude')
            ->wherePivot('exclude', false);
    }

    public function excludeProducts()
    {
        return $this->belongsToMany(Product::class, 'coupon_products')
            ->withPivot('exclude')
            ->wherePivot('exclude', true);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'coupon_categories')
            ->withPivot('exclude')
            ->wherePivot('exclude', false);
    }

    public function excludeCategories()
    {
        return $this->belongsToMany(Category::class, 'coupon_categories')
            ->withPivot('exclude')
            ->wherePivot('exclude', true);
    }

    public function orders()
    {
        return $this->hasMany(Order::class)->withTrashed();
    }

    public function customers()
    {
        return $this->hasManyThrough(
            User::class,
            Order::class,
            'coupon_id',
            'id',
            'id',
            'customer_id'
        )->withTrashed();
    }

    public function getValueAttribute($value)
    {
        if ($this->is_percent) {
            return $value;
        }

        return Money::inDefaultCurrency($value);
    }

    public function getMinimumSpendAttribute($minimumSpend)
    {
        if (! is_null($minimumSpend)) {
            return Money::inDefaultCurrency($minimumSpend);
        }
    }

    public function getMaximumSpendAttribute($maximumSpend)
    {
        if (! is_null($maximumSpend)) {
            return Money::inDefaultCurrency($maximumSpend);
        }
    }

    public function getTotalAttribute($total)
    {
        return Money::inDefaultCurrency($total);
    }

    /**
     * Get table data for the resource
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function table()
    {
        return new CouponTable($this->newQuery()->withoutGlobalScope('active'));
    }

    /**
     * Save associated relations for the coupon.
     *
     * @param array $attributes
     * @return void
     */
    public function saveRelations(array $attributes)
    {
        $this->syncProducts(array_get($attributes, 'products', []));
        $this->syncExcludeProducts(array_get($attributes, 'exclude_products', []));

        $this->syncCategories(array_get($attributes, 'categories', []));
        $this->syncExcludeCategories(array_get($attributes, 'exclude_categories', []));
    }
}
