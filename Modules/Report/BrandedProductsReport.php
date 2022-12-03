<?php

namespace Modules\Report;

use Modules\Brand\Entities\Brand;
use Illuminate\Database\Eloquent\Builder;

class BrandedProductsReport extends Report
{
    protected $filters = [];

    protected function view()
    {
        return 'report::admin.reports.branded_products_report.index';
    }

    protected function query()
    {
        return Brand::select('id')
            ->when(request()->has('brand'), function (Builder $query) {
                $query->whereTranslationLike('name', request('brand') . '%');
            })
            ->withCount('products')
            ->orderByDesc('products_count');
    }
}
