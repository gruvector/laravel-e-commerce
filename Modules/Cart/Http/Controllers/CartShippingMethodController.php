<?php

namespace Modules\Cart\Http\Controllers;

use Modules\Cart\Facades\Cart;
use Modules\Shipping\Facades\ShippingMethod;

class CartShippingMethodController
{
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $shippingMethod = ShippingMethod::get(request('shipping_method'));

        Cart::addShippingMethod($shippingMethod);

        return Cart::instance();
    }
}
