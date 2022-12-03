<?php

namespace Modules\Cart\Listeners;

use Modules\Cart\Facades\Cart;

class ClearCart
{
    /**
     * Handle the event.
     *
     * @return void
     */
    public function handle()
    {
        Cart::clear();
    }
}
