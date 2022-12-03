<?php

namespace Modules\Category\Http\Controllers;

use Modules\Category\Entities\Category;

class CategoryController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('public.categories.index', [
            'categories' => Category::all()->nest(),
        ]);
    }
}
