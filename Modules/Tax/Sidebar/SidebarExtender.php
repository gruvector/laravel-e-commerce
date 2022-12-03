<?php

namespace Modules\Tax\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\Admin\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(trans('admin::sidebar.system'), function (Group $group) {
            $group->item(trans('admin::sidebar.localization'), function (Item $item) {
                $item->item(trans('tax::sidebar.taxes'), function (Item $item) {
                    $item->weight(15);
                    $item->route('admin.taxes.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.taxes.index')
                    );
                });
            });
        });
    }
}
