<?php

namespace Modules\Coupon\Entities\Concerns;

trait RelationList
{
    /**
     * Get the list of the coupon applicable products.
     *
     * @return array
     */
    public function productList()
    {
        return $this->getItemList('products');
    }

    /**
     * Get the list of the excluded products.
     *
     * @return array
     */
    public function excludeProductList()
    {
        return $this->getItemList('excludeProducts');
    }

    /**
     * Get the item list for the given coupon with the given attribute.
     *
     * @param string $attributes
     * @return array
     */
    private function getItemList($attribute)
    {
        $items = $this->getAttribute($attribute);

        return $items->mapWithKeys(function ($item) {
            return [$item->id => $item->name];
        })->all();
    }
}
