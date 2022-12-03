<?php

namespace Modules\Coupon\Checkers;

use Closure;
use Modules\Cart\Facades\Cart;
use Modules\Coupon\Exceptions\CouponAlreadyAppliedException;

class AlreadyApplied
{
    public function handle($coupon, Closure $next)
    {
        if (Cart::couponAlreadyApplied($coupon)) {
            throw new CouponAlreadyAppliedException;
        }

        return $next($coupon);
    }
}
