<?php

namespace Modules\Translation\Sidebar;

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
                $item->weight(10);
                $item->icon('fa fa-globe');
                $item->route('admin.translations.index');
                $item->authorize(
                    $this->auth->hasAccess('admin.translations.index')
                );

                $item->item(trans('translation::sidebar.translations'), function (Item $item) {
                    $item->route('admin.translations.index');
                    $item->weight(5);
                    $item->authorize(
                        $this->auth->hasAccess('admin.translations.index')
                    );
                });
            });
        });
    }
}
