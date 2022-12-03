<?php

namespace Modules\Product;

use Darryldecode\Cart\Cart as DarryldecodeCart;

class RecentlyViewed extends DarryldecodeCart
{
    public function store($product)
    {
        $product->load('reviews');

        $this->remove($product->id);

        return $this->add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->selling_price->amount(),
            'quantity' => 1,
            'attributes' => compact('product'),
        ]);
    }

    public function products()
    {
        return $this->getContent()->map(function ($item) {
            return $item->attributes->product;
        });
    }
}
