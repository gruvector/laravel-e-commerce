<?php

namespace Modules\User\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\Admin\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(trans('admin::sidebar.system'), function (Group $group) {
            $group->item(trans('user::sidebar.users'), function (Item $item) {
                $item->weight(5);
                $item->icon('fa fa-users');
                $item->route('admin.users.index');
                $item->authorize(
                    $this->auth->hasAccess('admin.users.index') || $this->auth->hasAccess('roles.index')
                );

                // users
                $item->item(trans('user::sidebar.users'), function (Item $item) {
                    $item->weight(5);
                    $item->route('admin.users.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.users.index')
                    );
                });

                // roles
                $item->item(trans('user::sidebar.roles'), function (Item $item) {
                    $item->weight(10);
                    $item->route('admin.roles.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.roles.index')
                    );
                });
            });
        });
    }
}
