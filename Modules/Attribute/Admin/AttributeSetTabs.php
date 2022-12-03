<?php

namespace Modules\Attribute\Admin;

use Modules\Admin\Ui\Tab;
use Modules\Admin\Ui\Tabs;

class AttributeSetTabs extends Tabs
{
    public function make()
    {
        $this->group('attribute_set_information', trans('attribute::attribute_sets.tabs.group.attribute_set_information'))
            ->active()
            ->add($this->general());
    }

    private function general()
    {
        return tap(new Tab('general', trans('attribute::attribute_sets.tabs.general')), function (Tab $tab) {
            $tab->active();
            $tab->fields('name');
            $tab->view('attribute::admin.attribute_sets.tabs.general');
        });
    }
}
