<?php

namespace Modules\Report;

use Modules\Tax\Entities\TaxClass;
use Illuminate\Database\Eloquent\Builder;

class TaxedProductsReport extends Report
{
    protected $filters = [];

    protected function view()
    {
        return 'report::admin.reports.taxed_products_report.index';
    }

    protected function data()
    {
        return ['taxClasses' => TaxClass::list()];
    }

    protected function query()
    {
        return TaxClass::select('id')
            ->when(request()->has('tax_class'), function (Builder $query) {
                $query->where('id', request('tax_class'));
            })
            ->withCount('products')
            ->orderByDesc('products_count');
    }
}
