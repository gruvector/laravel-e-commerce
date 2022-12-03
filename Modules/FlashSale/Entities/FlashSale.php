<?php

namespace Modules\FlashSale\Entities;

use Modules\Support\Money;
use Modules\Admin\Ui\AdminTable;
use Modules\Support\Eloquent\Model;
use Modules\Product\Entities\Product;
use Modules\Support\Eloquent\Translatable;

class FlashSale extends Model
{
    use Translatable;

    /**
     * Active flash sale.
     *
     * @var self
     */
    private static $active;

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
    protected $fillable = ['id'];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = ['campaign_name'];

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    protected static function booted()
    {
        static::saved(function ($flashSale) {
            if (! empty(request()->has('products'))) {
                $flashSale->saveProducts(request('products'));
            }
        });
    }

    /**
     * Get the active flash sale.
     *
     * @param int $id
     * @return self
     */
    public static function active()
    {
        if (is_callable(self::$active)) {
            return call_user_func(self::$active);
        }

        return new self;
    }

    /**
     * Set an active flash sale campaign.
     *
     * @param int $id
     * @return void
     */
    public static function activeCampaign($id)
    {
        self::$active = function () use ($id) {
            return once(function () use ($id) {
                return self::withEligibleProducts()->where('id', $id)->firstOrNew([]);
            });
        };
    }

    public static function contains(Product $product)
    {
        return self::active()->products->contains($product);
    }

    public static function pivot(Product $product)
    {
        return self::active()->products->find($product)->pivot;
    }

    public static function remainingQty(Product $product)
    {
        $flashSaleProduct = self::pivot($product);

        return $flashSaleProduct->qty - $flashSaleProduct->sold;
    }

    public function scopeWithEligibleProducts($query)
    {
        $query->with(['products' => function ($query) {
            $query->forCard()->wherePivot('end_date', '>', now());
        }]);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'flash_sale_products')
            ->using(FlashSaleProduct::class)
            ->withPivot(['id', 'end_date', 'price', 'qty'])
            ->orderBy('position');
    }

    public function getPriceAttribute($price)
    {
        return Money::inDefaultCurrency($price);
    }

    public function saveProducts($products)
    {
        $this->products()->sync(
            $this->buildProductPivots($products)
        );
    }

    private function buildProductPivots($products)
    {
        return collect($products)->values()->mapWithKeys(function ($attributes, $index) {
            return [$attributes['product_id'] => [
                'end_date' => $attributes['end_date'],
                'price' => $attributes['price'],
                'qty' => $attributes['qty'],
                'position' => $index,
            ]];
        });
    }

    public function table()
    {
        return new AdminTable($this->query());
    }
}
