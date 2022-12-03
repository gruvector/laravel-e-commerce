<?php

namespace Modules\Category\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\Admin\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(trans('admin::sidebar.content'), function (Group $group) {
            $group->item(trans('product::sidebar.products'), function (Item $item) {
                $item->item(trans('category::sidebar.categories'), function (Item $item) {
                    $item->weight(10);
                    $item->route('admin.categories.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.categories.index')
                    );
                });
            });
        });
    }
}
