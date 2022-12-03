<?php

namespace Modules\Menu\Services;

use Modules\Menu\Entities\MenuItem;

class MenuItemOrdener
{
    /**
     * Order the menu items.
     *
     * @param array $rootItem
     * @return void
     */
    public function order(array $rootItem)
    {
        $this->orderChildren($rootItem['id'], $rootItem['children']);
    }

    /**
     * Order child menu items recursively.
     *
     * @param int $parentId
     * @param array $childItems
     * @return void
     */
    private function orderChildren($parentId, array $childItems)
    {
        foreach ($childItems as $position => $childItem) {
            $menuItem = MenuItem::find($childItem['id']);

            if (is_null($menuItem)) {
                continue;
            }

            $menuItem->update(['parent_id' => $parentId, 'position' => $position]);

            if (isset($childItem['children'])) {
                $this->orderChildren($childItem['id'], $childItem['children']);
            }
        }
    }
}
