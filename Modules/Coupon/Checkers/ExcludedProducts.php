<?php

namespace Modules\Coupon\Checkers;

use Closure;
use Modules\Cart\Facades\Cart;
use Modules\Coupon\Exceptions\InapplicableCouponException;

class ExcludedProducts
{
    public function handle($coupon, Closure $next)
    {
        $coupon->load('excludeProducts');

        if ($coupon->excludeProducts->isEmpty()) {
            return $next($coupon);
        }

        foreach (Cart::items() as $cartItem) {
            if ($this->inExcludedProducts($coupon, $cartItem)) {
                throw new InapplicableCouponException;
            }
        }

        return $next($coupon);
    }

    private function inExcludedProducts($coupon, $cartItem)
    {
        return $coupon->excludeProducts->contains($cartItem->product);
    }
}
