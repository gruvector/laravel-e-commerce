<?php

namespace Modules\Option\Admin;

use Modules\Admin\Ui\Tab;
use Modules\Admin\Ui\Tabs;

class OptionTabs extends Tabs
{
    public function make()
    {
        $this->group('option_information', trans('option::options.tabs.group.option_information'))
            ->active()
            ->add($this->general())
            ->add($this->values());
    }

    private function general()
    {
        return tap(new Tab('general', trans('option::options.tabs.general')), function (Tab $tab) {
            $tab->active();
            $tab->weight(10);
            $tab->fields(['name', 'type', 'is_required']);
            $tab->view('option::admin.options.tabs.general');
        });
    }

    private function values()
    {
        return tap(new Tab('values', trans('option::options.tabs.values')), function (Tab $tab) {
            $tab->weight(20);
            $tab->fields(['values.*.label', 'values.*.price', 'values.*.price_type']);
            $tab->view('option::admin.options.tabs.values');
        });
    }
}
