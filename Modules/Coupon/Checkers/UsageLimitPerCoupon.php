<?php

namespace Modules\Coupon\Checkers;

use Closure;
use Modules\Coupon\Exceptions\CouponUsageLimitReachedException;

class UsageLimitPerCoupon
{
    public function handle($coupon, Closure $next)
    {
        if ($coupon->usageLimitReached()) {
            throw new CouponUsageLimitReachedException;
        }

        return $next($coupon);
    }
}
