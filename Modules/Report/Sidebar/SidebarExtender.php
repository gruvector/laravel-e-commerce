<?php

namespace Modules\Report\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\Admin\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(trans('admin::sidebar.system'), function (Group $group) {
            $group->item(trans('report::sidebar.reports'), function (Item $item) {
                $item->icon('fa fa-bar-chart');
                $item->weight(20);
                $item->route('admin.reports.index');
                $item->authorize(
                    $this->auth->hasAccess('admin.reports.index')
                );
            });
        });
    }
}
