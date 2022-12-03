<?php

namespace Modules\Shipping;

use Modules\Support\Manager;

class ShippingMethodManager extends Manager
{
    public function available()
    {
        return $this->all()->filter->available();
    }
}
