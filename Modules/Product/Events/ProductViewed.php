<?php

namespace Modules\Product\Events;

use Illuminate\Queue\SerializesModels;

class ProductViewed
{
    use SerializesModels;

    /**
     * The product entity.
     *
     * @var \Modules\Product\Entities\Product
     */
    public $product;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($product)
    {
        $this->product = $product;
    }
}
