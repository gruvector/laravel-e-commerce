<?php

namespace Modules\Product\Events;

use Illuminate\Queue\SerializesModels;

class ShowingProductList
{
    use SerializesModels;

    /**
     * Collection of product.
     *
     * @var \Illuminate\Database\Eloquent\Collection
     */
    public $products;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($products)
    {
        $this->products = $products;
    }
}
