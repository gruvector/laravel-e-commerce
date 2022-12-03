<?php

namespace Modules\Order\Entities;

use Modules\Support\Money;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderTax extends Pivot
{
    public function getAmountAttribute($amount)
    {
        return Money::inDefaultCurrency($amount);
    }
}
