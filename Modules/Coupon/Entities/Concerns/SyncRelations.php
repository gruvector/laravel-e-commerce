<?php

namespace Modules\Coupon\Entities\Concerns;

trait SyncRelations
{
    protected function syncProducts($products)
    {
        $this->products()->sync(
            $this->makeSyncList($products, ['exclude' => false])
        );
    }

    protected function syncExcludeProducts($excludeProducts)
    {
        $this->excludeProducts()->sync(
            $this->makeSyncList($excludeProducts, ['exclude' => true])
        );
    }

    protected function syncCategories($categories)
    {
        $this->categories()->sync(
            $this->makeSyncList($categories, ['exclude' => false])
        );
    }

    protected function syncExcludeCategories($excludeCategories)
    {
        $this->excludeCategories()->sync(
            $this->makeSyncList($excludeCategories, ['exclude' => true])
        );
    }

    private function makeSyncList($items, $pivotData)
    {
        $pivotData = array_fill(0, count($items), $pivotData);

        return array_combine($items, $pivotData);
    }
}
