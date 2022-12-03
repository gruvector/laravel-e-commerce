<?php

namespace Modules\Coupon\Checkers;

use Closure;
use Modules\Coupon\Exceptions\InvalidCouponException;

class ValidCoupon
{
    public function handle($coupon, Closure $next)
    {
        if ($coupon->invalid()) {
            throw new InvalidCouponException;
        }

        return $next($coupon);
    }
}
