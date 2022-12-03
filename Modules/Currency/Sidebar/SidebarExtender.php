<?php

namespace Modules\Currency\Sidebar;

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
                $item->item(trans('currency::currency_rates.currency_rates'), function (Item $item) {
                    $item->route('admin.currency_rates.index');
                    $item->weight(10);
                    $item->authorize(
                        $this->auth->hasAccess('admin.currency_rates.index')
                    );
                });
            });
        });
    }
}
