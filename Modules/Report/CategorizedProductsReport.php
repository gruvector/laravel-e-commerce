<?php

namespace Modules\Report;

use Modules\Category\Entities\Category;
use Illuminate\Database\Eloquent\Builder;

class CategorizedProductsReport extends Report
{
    protected $filters = [];

    protected function view()
    {
        return 'report::admin.reports.categorized_products_report.index';
    }

    protected function query()
    {
        return Category::withoutGlobalScope('active')
            ->select('id')
            ->when(request()->has('category'), function (Builder $query) {
                $query->whereTranslationLike('name', request('category') . '%');
            })
            ->withCount('products')
            ->orderByDesc('products_count');
    }
}
