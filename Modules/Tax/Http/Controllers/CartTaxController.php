<?php

namespace Modules\Tax\Http\Controllers;

use Illuminate\Http\Request;
use Modules\Cart\Facades\Cart;

class CartTaxController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->mergeShippingAddress($request);

        Cart::addTaxes($request);

        return Cart::instance();
    }

    private function mergeShippingAddress($request)
    {
        $request->merge([
            'shipping' => $request->ship_to_a_different_address ? $request->shipping : $request->billing,
        ]);
    }
}
