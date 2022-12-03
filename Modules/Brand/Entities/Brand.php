<?php

namespace Modules\Brand\Entities;

use Modules\Media\Entities\File;
use Modules\Brand\Admin\BrandTable;
use Modules\Support\Eloquent\Model;
use Modules\Media\Eloquent\HasMedia;
use Illuminate\Support\Facades\Cache;
use Modules\Product\Entities\Product;
use Modules\Meta\Eloquent\HasMetaData;
use Modules\Support\Eloquent\Sluggable;
use Modules\Support\Eloquent\Translatable;

class Brand extends Model
{
    use Translatable, Sluggable, HasMedia, HasMetaData;

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
    protected $fillable = ['slug', 'is_active'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * The attributes that are translatable.
     *
     * @var array
     */
    public $translatedAttributes = ['name'];

    /**
     * The attribute that will be slugged.
     *
     * @var string
     */
    protected $slugAttribute = 'name';

    /**
     * Perform any actions required after the model boots.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addActiveGlobalScope();
    }

    /**
     * Get public url for the brand.
     *
     * @return string
     */
    public function url()
    {
        return route('brands.products.index', $this->slug);
    }

    /**
     * Find a specific brand by the given slug.
     *
     * @param string $slug
     * @return self
     */
    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->firstOrNew([]);
    }

    /**
     * Get brand list.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public static function list()
    {
        return Cache::tags('brands')->rememberForever(md5('brands.list:' . locale()), function () {
            return self::all()->sortBy('name')->pluck('name', 'id');
        });
    }

    /**
     * Get the brand's logo.
     *
     * @return \Modules\Media\Entities\File
     */
    public function getLogoAttribute()
    {
        return $this->files->where('pivot.zone', 'logo')->first() ?: new File;
    }

    /**
     * Get the brand's banner.
     *
     * @return \Modules\Media\Entities\File
     */
    public function getBannerAttribute()
    {
        return $this->files->where('pivot.zone', 'banner')->first() ?: new File;
    }

    /**
     * Get related products.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Get table data for the resource
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function table()
    {
        return new BrandTable($this->newQuery()->withoutGlobalScope('active'));
    }
}
