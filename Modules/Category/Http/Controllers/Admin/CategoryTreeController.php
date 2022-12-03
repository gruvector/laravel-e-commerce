<?php

namespace Modules\Category\Http\Controllers\Admin;

use Modules\Category\Entities\Category;
use Modules\Category\Services\CategoryTreeUpdater;
use Modules\Category\Http\Responses\CategoryTreeResponse;

class CategoryTreeController
{
    /**
     * Display category tree in json.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::withoutGlobalScope('active')
            ->orderByRaw('-position DESC')
            ->get();

        return new CategoryTreeResponse($categories);
    }

    /**
     * Update category tree in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        CategoryTreeUpdater::update(request('category_tree'));

        return trans('category::messages.category_order_saved');
    }
}
