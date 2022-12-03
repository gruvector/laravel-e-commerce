<?php

namespace Modules\Slider\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\Admin\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(trans('admin::sidebar.system'), function (Group $group) {
            $group->item(trans('admin::sidebar.appearance'), function (Item $item) {
                $item->item(trans('slider::sliders.sliders'), function (Item $item) {
                    $item->weight(5);
                    $item->route('admin.sliders.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.sliders.index')
                    );
                });
            });
        });
    }
}
