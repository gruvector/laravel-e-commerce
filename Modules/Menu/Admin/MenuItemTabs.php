<?php

namespace Modules\Menu\Admin;

use Modules\Admin\Ui\Tab;
use Modules\Admin\Ui\Tabs;
use Modules\Page\Entities\Page;
use Modules\Menu\Entities\MenuItem;
use Modules\Category\Entities\Category;

class MenuItemTabs extends Tabs
{
    /**
     * Make new tabs with groups.
     *
     * @return void
     */
    public function make()
    {
        $this->group('menu_item_information', trans('menu::menu_items.tabs.group.menu_item_information'))
            ->active()
            ->add($this->general())
            ->add($this->image());
    }

    private function general()
    {
        return tap(new Tab('general', trans('menu::menu_items.tabs.general')), function (Tab $tab) {
            $tab->active();
            $tab->weight(5);
            $tab->view('menu::admin.menu_items.tabs.general', [
                'categories' => $this->categories(),
                'pages' => $this->pages(),
                'parentMenuItems' => $this->parentMenuItems(),
            ]);
        });
    }

    private function categories()
    {
        return Category::where('parent_id', null)->get()->sortBy('name')->pluck('name', 'id')
            ->prepend(trans('menu::menu_items.form.select_category'), '');
    }

    private function pages()
    {
        return Page::all()->sortBy('name')->pluck('name', 'id')
            ->prepend(trans('menu::menu_items.form.select_page'), '');
    }

    private function parentMenuItems()
    {
        $parentMenuItems = ['' => trans('menu::menu_items.form.select_parent')];

        return $parentMenuItems += MenuItem::parents(request('menuId'), request('id'));
    }

    private function image()
    {
        return tap(new Tab('image', trans('menu::menu_items.tabs.image')), function (Tab $tab) {
            if (! auth()->user()->hasAccess('admin.media.index')) {
                return;
            }

            $tab->weight(10);
            $tab->view('menu::admin.menu_items.tabs.image');
        });
    }
}
