<?php

namespace Modules\Tag\Sidebar;

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
                $item->item(trans('tag::tags.tags'), function (Item $item) {
                    $item->icon('fa fa-tag');
                    $item->weight(27);
                    $item->route('admin.tags.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.tags.index')
                    );
                });
            });
        });
    }
}
