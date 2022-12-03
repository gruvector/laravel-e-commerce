<?php

namespace Modules\Shipping;

use Modules\Support\Money;
use Modules\Cart\Facades\Cart;

class Method
{
    public $name;
    public $label;
    public $cost;

    public function __construct($name, $label, $cost)
    {
        $this->name = $name;
        $this->label = $label;
        $this->cost = Money::inDefaultCurrency($cost);
    }

    public function available()
    {
        if ($this->name !== 'free_shipping') {
            return true;
        }

        return $this->freeShippingMethodIsAvailable();
    }

    private function freeShippingMethodIsAvailable()
    {
        $minimumAmount = Money::inDefaultCurrency(setting('free_shipping_min_amount'));

        return Cart::subTotal()->greaterThanOrEqual($minimumAmount);
    }
}
