<?php

namespace Modules\Tax\Entities;

use Modules\Admin\Ui\AdminTable;
use Modules\Support\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Modules\Product\Entities\Product;
use Modules\Support\Eloquent\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxClass extends Model
{
    use Translatable, SoftDeletes;

    const SHIPPING_ADDRESS = 'shipping_address';
    const BILLING_ADDRESS = 'billing_address';
    const STORE_ADDRESS = 'store_address';

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
    protected $fillable = ['based_on'];

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
    public $translatedAttributes = ['label'];

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    protected static function booted()
    {
        static::saved(function ($taxClass) {
            $taxClass->saveRates(request('rates', []));
        });
    }

    /**
     * Get tag list.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function list()
    {
        return Cache::tags('tax_classes')->rememberForever(md5('tax_classes.list:' . locale()), function () {
            return self::all()->sortBy('label')->pluck('label', 'id');
        });
    }

    public function findTaxRate($addresses)
    {
        return $this->taxRates()
            ->findByAddress($this->determineAddress($addresses))
            ->first();
    }

    public function determineAddress($addresses)
    {
        if ($this->based_on === self::SHIPPING_ADDRESS) {
            return $addresses['shipping'] ?? [];
        }

        if ($this->based_on === self::BILLING_ADDRESS) {
            return $addresses['billing'] ?? [];
        }

        if ($this->based_on === self::STORE_ADDRESS) {
            return [
                'address_1' => setting('store_address_1'),
                'address_2' => setting('store_address_2'),
                'city' => setting('store_city'),
                'state' => setting('store_state'),
                'zip' => setting('store_zip'),
                'country' => setting('store_country'),
            ];
        }

        return [];
    }

    public function taxRates()
    {
        return $this->hasMany(TaxRate::class)->orderBy('position');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function table()
    {
        return new AdminTable($this->newQuery());
    }

    public function saveRates($rates = [])
    {
        $ids = $this->getDeleteCandidates($rates);

        if ($ids->isNotEmpty()) {
            $this->taxRates()->whereIn('id', $ids)->delete();
        }

        foreach (array_reset_index($rates) as $index => $rate) {
            $this->taxRates()->updateOrCreate(
                ['id' => $rate['id']],
                $rate + ['position' => $index]
            );
        }
    }

    private function getDeleteCandidates($rates = [])
    {
        return $this->taxRates()
            ->pluck('id')
            ->diff(array_pluck($rates, 'id'));
    }
}
