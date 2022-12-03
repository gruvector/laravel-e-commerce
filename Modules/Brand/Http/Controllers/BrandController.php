<?php

namespace Modules\Brand\Http\Controllers;

use Modules\Brand\Entities\Brand;

class BrandController
{
    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('public.brands.index', [
            'brands' => Brand::with('files')->get(),
        ]);
    }
}
