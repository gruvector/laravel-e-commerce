<?php

namespace Modules\Cart;

use Darryldecode\Cart\CartCondition as DarryldecodeCartCondition;

class CartCondition extends DarryldecodeCartCondition
{
    public function getAttribute($key, $default = null)
    {
        return array_get($this->getAttributes(), $key, $default);
    }
}
