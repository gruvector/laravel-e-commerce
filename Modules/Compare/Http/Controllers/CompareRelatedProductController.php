<?php

namespace Modules\Compare\Http\Controllers;

use Modules\Compare\Compare;

class CompareRelatedProductController
{
    /**
     * Display a listing of the resource.
     *
     * @param \Modules\Compare\Compare $compare
     * @return \Illuminate\Http\Response
     */
    public function index(Compare $compare)
    {
        return $compare->relatedProducts();
    }
}
