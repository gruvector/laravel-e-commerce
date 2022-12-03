<?php

namespace Modules\Cart\Http\Controllers;

class CartController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('public.cart.index');
    }
}
