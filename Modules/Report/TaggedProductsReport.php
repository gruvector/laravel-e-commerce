<?php

namespace Modules\Report;

use Modules\Tag\Entities\Tag;
use Illuminate\Database\Eloquent\Builder;

class TaggedProductsReport extends Report
{
    protected $filters = [];

    protected function view()
    {
        return 'report::admin.reports.tagged_products_report.index';
    }

    protected function query()
    {
        return Tag::select('id')
            ->when(request()->has('tag'), function (Builder $query) {
                $query->whereTranslationLike('name', request('tag') . '%');
            })
            ->withCount('products')
            ->orderByDesc('products_count');
    }
}
