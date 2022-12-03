<?php

namespace Modules\Attribute\Listeners;

use Modules\Product\Entities\Product;
use Modules\Attribute\Entities\ProductAttributeValue;

class SaveProductAttributes
{
    /**
     * Handle the event.
     *
     * @param \Modules\Product\Entities\Product $product
     * @return void
     */
    public function handle(Product $product)
    {
        $this->deleteProductAttributes($product);
        $this->createProductAttributes($product);
    }

    /**
     * Delete all product attributes associated with the given product.
     *
     * @param \Modules\Product\Entities\Product $product
     * @return void
     */
    private function deleteProductAttributes(Product $product)
    {
        $product->attributes()->delete();
    }

    /**
     * Create product attributes for the given product.
     *
     * @param \Modules\Product\Entities\Product $product
     * @return void
     */
    private function createProductAttributes(Product $product)
    {
        $productAttributeValues = [];

        foreach (request('attributes', []) as $attribute) {
            $productAttribute = $product->attributes()->create([
                'attribute_id' => $attribute['attribute_id'],
            ]);

            foreach ($attribute['values'] as $valueId) {
                $productAttributeValues[] = [
                    'product_attribute_id' => $productAttribute->id,
                    'attribute_value_id' => $valueId,
                ];
            }
        }

        $this->createProductAttributeValues($productAttributeValues);
    }

    /**
     * Create the given product attribute values.
     *
     * @param array $productAttributeValues
     * @return void
     */
    private function createProductAttributeValues(array $productAttributeValues)
    {
        ProductAttributeValue::insert($productAttributeValues);
    }
}
