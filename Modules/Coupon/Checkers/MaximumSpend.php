<?php

namespace Modules\Coupon\Checkers;

use Closure;
use Modules\Coupon\Exceptions\MaximumSpendException;

class MaximumSpend
{
    public function handle($coupon, Closure $next)
    {
        if ($coupon->spentMoreThanMaximumAmount()) {
            throw new MaximumSpendException($coupon->maximum_spend);
        }

        return $next($coupon);
    }
}
