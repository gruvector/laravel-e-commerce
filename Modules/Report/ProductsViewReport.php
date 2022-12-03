<?php

namespace Modules\Report;

use Modules\Product\Entities\Product;

class ProductsViewReport extends Report
{
    protected $filters = [];

    protected function view()
    {
        return 'report::admin.reports.products_view_report.index';
    }

    protected function query()
    {
        return Product::withoutGlobalScope('active')
            ->select('id', 'viewed')
            ->when(request()->has('product'), function ($query) {
                $query->whereTranslationLike('name', request('product') . '%');
            })
            ->when(request()->has('sku'), function ($query) {
                $query->where('sku', request('sku'));
            })
            ->orderByDesc('viewed');
    }
}
