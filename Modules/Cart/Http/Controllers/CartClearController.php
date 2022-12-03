<?php

namespace Modules\Cart\Http\Controllers;

use Modules\Cart\Facades\Cart;

class CartClearController
{
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        Cart::clear();

        return Cart::instance();
    }
}
