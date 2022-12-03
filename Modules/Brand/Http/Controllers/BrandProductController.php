<?php

namespace Modules\Brand\Http\Controllers;

use Modules\Brand\Entities\Brand;
use Modules\Product\Entities\Product;
use Modules\Product\Filters\ProductFilter;
use Modules\Product\Http\Controllers\ProductSearch;

class BrandProductController
{
    use ProductSearch;

    /**
     * Display a listing of the resource.
     *
     * @param string $slug
     * @param \Modules\Product\Entities\Product $model
     * @param \Modules\Product\Filters\ProductFilter $productFilter
     * @return \Illuminate\Http\Response
     */
    public function index($slug, Product $model, ProductFilter $productFilter)
    {
        request()->merge(['brand' => $slug]);

        if (request()->expectsJson()) {
            return $this->searchProducts($model, $productFilter);
        }

        $brand = Brand::findBySlug($slug);

        return view('public.products.index', [
            'brandName' => $brand->name,
            'brandBanner' => $brand->banner->path,
        ]);
    }
}
