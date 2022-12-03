<?php

namespace Modules\Import\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\Admin\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(trans('admin::sidebar.system'), function (Group $group) {
            $group->item(trans('admin::sidebar.tools'), function (Item $item) {
                $item->item(trans('import::sidebar.import'), function (Item $item) {
                    $item->weight(5);
                    $item->route('admin.importer.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.importer.index')
                    );
                });
            });
        });
    }
}
