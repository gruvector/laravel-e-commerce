<?php

namespace Modules\Setting\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\Admin\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(trans('admin::sidebar.system'), function (Group $group) {
            $group->item(trans('setting::sidebar.settings'), function (Item $item) {
                $item->weight(25);
                $item->icon('fa fa-cogs');
                $item->route('admin.settings.edit');
                $item->authorize(
                    $this->auth->hasAccess('admin.settings.edit')
                );
            });
        });
    }
}
