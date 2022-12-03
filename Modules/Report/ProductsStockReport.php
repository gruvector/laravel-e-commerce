<?php

namespace Modules\Report;

use Modules\Product\Entities\Product;

class ProductsStockReport extends Report
{
    protected function view()
    {
        return 'report::admin.reports.products_stock_report.index';
    }

    protected function query()
    {
        return Product::select('id', 'qty', 'in_stock')
            ->withName()
            ->when(request()->has('quantity_above'), function ($query) {
                $query->where('manage_stock', true)
                    ->where('qty', '>', request('quantity_above'));
            })
            ->when(request()->has('quantity_below'), function ($query) {
                $query->where('manage_stock', true)
                    ->where('qty', '<', request('quantity_below'));
            })
            ->when(request('stock_availability') === 'in_stock', function ($query) {
                $query->where('in_stock', true);
            })
            ->when(request('stock_availability') === 'out_of_stock', function ($query) {
                $query->where('in_stock', false);
            })
            ->orderByDesc('qty');
    }
}
