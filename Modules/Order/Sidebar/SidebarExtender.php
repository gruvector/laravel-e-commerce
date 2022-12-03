<?php

namespace Modules\Order\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\Admin\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(trans('admin::sidebar.content'), function (Group $group) {
            $group->item(trans('admin::sidebar.sales'), function (Item $item) {
                $item->icon('fa fa-dollar');
                $item->weight(15);
                $item->route('admin.orders.index');
                $item->authorize(
                    $this->auth->hasAnyAccess(['admin.orders.index', 'admin.transactions.index'])
                );

                $item->item(trans('order::orders.orders'), function (Item $item) {
                    $item->weight(5);
                    $item->route('admin.orders.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.orders.index')
                    );
                });
            });
        });
    }
}
