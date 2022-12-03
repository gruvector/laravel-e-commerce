<?php

namespace Modules\Attribute\Sidebar;

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
                // attributes
                $item->item(trans('attribute::sidebar.attributes'), function (Item $item) {
                    $item->weight(15);
                    $item->route('admin.attributes.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.attributes.index')
                    );
                });

                // attribute sets
                $item->item(trans('attribute::sidebar.attribute_sets'), function (Item $item) {
                    $item->weight(20);
                    $item->route('admin.attribute_sets.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.attribute_sets.index')
                    );
                });
            });
        });
    }
}
