<?php

namespace Modules\Compare\Http\Controllers;

use Modules\Compare\Compare;

class CompareController
{
    /**
     * Display a listing of the resource.
     *
     * @param \Modules\Compare\Compare $compare
     * @return \Illuminate\Http\Response
     */
    public function index(Compare $compare)
    {
        return view('public.compare.index', compact('compare'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Modules\Compare\Compare $compare
     * @return \Illuminate\Http\Response
     */
    public function store(Compare $compare)
    {
        $compare->store(request('productId'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $productId
     * @param \Modules\Compare\Compare $compare
     * @return \Illuminate\Http\Response
     */
    public function destroy($productId, Compare $compare)
    {
        $compare->remove($productId);
    }
}
