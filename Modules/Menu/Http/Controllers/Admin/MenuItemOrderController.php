<?php

namespace Modules\Menu\Http\Controllers\Admin;

use Modules\Menu\Services\MenuItemOrdener;

class MenuItemOrderController
{
    /**
     * Update the specified resource in storage.
     *
     * @param \Modules\Menu\Services\MenuItemOrdener $ordener
     * @return void
     */
    public function update(MenuItemOrdener $ordener)
    {
        $ordener->order(request()->json()->all());
    }
}
