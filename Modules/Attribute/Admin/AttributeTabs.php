<?php

namespace Modules\Attribute\Admin;

use Modules\Admin\Ui\Tab;
use Modules\Admin\Ui\Tabs;
use Modules\Category\Entities\Category;
use Modules\Attribute\Entities\AttributeSet;

class AttributeTabs extends Tabs
{
    public function make()
    {
        $this->group('attribute_set_information', trans('attribute::admin.tabs.group.attribute_information'))
            ->active()
            ->add($this->general())
            ->add($this->values());
    }

    private function general()
    {
        return tap(new Tab('general', trans('attribute::admin.tabs.general')), function (Tab $tab) {
            $tab->active();
            $tab->weight(5);
            $tab->fields(['attribute_set_id', 'name', 'slug']);
            $tab->view('attribute::admin.attributes.tabs.general', [
                'attributeSets' => $this->getAttributeSets(),
                'categories' => Category::treeList(),
            ]);
        });
    }

    private function getAttributeSets()
    {
        return AttributeSet::all()->sortBy('name')->pluck('name', 'id')
            ->prepend(trans('admin::admin.form.please_select'), '');
    }

    private function values()
    {
        return tap(new Tab('values', trans('attribute::admin.tabs.values')), function (Tab $tab) {
            $tab->weight(10);
            $tab->view('attribute::admin.attributes.tabs.values');
        });
    }
}
