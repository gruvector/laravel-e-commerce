<?php

namespace Modules\Coupon\Checkers;

use Closure;
use Modules\Cart\Facades\Cart;
use Modules\Coupon\Exceptions\InapplicableCouponException;

class ApplicableProducts
{
    public function handle($coupon, Closure $next)
    {
        $coupon->load('products');

        if ($coupon->products->isEmpty()) {
            return $next($coupon);
        }

        $cartItems = Cart::items()->filter(function ($cartItem) use ($coupon) {
            return $coupon->products->contains($cartItem->product);
        });

        if ($cartItems->isEmpty()) {
            throw new InapplicableCouponException;
        }

        return $next($coupon);
    }
}
