<?php

namespace Modules\Order\Entities;

use Modules\Support\Money;
use Illuminate\Database\Eloquent\Relations\Pivot;

class OrderProductOptionValue extends Pivot
{
    public function getPriceAttribute($price)
    {
        return Money::inDefaultCurrency($price);
    }
}
