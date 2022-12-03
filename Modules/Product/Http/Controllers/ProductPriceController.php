<?php

namespace Modules\Product\Http\Controllers;

use Modules\Cart\CartItem;
use Darryldecode\Cart\ItemCollection;
use Modules\Product\Entities\Product;
use Modules\Product\Services\ChosenProductOptions;

class ProductPriceController
{
    /**
     * Show the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::queryWithoutEagerRelations()
            ->select('id')
            ->withPrice()
            ->findOrFail($id);

        $variantPrice = $this->cartItem($product, request('options', []))
            ->total()
            ->convertToCurrentCurrency()
            ->format();

        return product_price_formatted($product, function ($price) use ($product, $variantPrice) {
            if (! $product->hasSpecialPrice()) {
                return $variantPrice;
            }

            return "{$variantPrice} <span class='previous-price'>{$price}</span>";
        });
    }

    private function cartItem(Product $product, array $options)
    {
        $chosenOptions = new ChosenProductOptions($product, $options);

        return new CartItem(new ItemCollection([
            'id' => $product->id,
            'quantity' => 1,
            'attributes' => [
                'product' => $product,
                'options' => $chosenOptions->getEntities(),
            ],
        ]));
    }
}
