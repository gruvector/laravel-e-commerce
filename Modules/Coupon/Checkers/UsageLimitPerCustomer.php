<?php

namespace Modules\Coupon\Checkers;

use Closure;
use Modules\Coupon\Exceptions\CouponUsageLimitReachedException;

class UsageLimitPerCustomer
{
    public function handle($coupon, Closure $next)
    {
        if ($coupon->perCustomerUsageLimitReached()) {
            throw new CouponUsageLimitReachedException;
        }

        return $next($coupon);
    }
}
