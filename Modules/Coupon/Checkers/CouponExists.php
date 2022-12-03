<?php

namespace Modules\Coupon\Checkers;

use Closure;
use Modules\Coupon\Exceptions\CouponNotExistsException;

class CouponExists
{
    public function handle($coupon, Closure $next)
    {
        if (is_null($coupon)) {
            throw new CouponNotExistsException;
        }

        return $next($coupon);
    }
}
