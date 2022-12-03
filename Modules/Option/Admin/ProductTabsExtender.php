<?php

namespace Modules\Option\Admin;

use Modules\Admin\Ui\Tab;
use Modules\Admin\Ui\Tabs;
use Modules\Option\Entities\Option;

class ProductTabsExtender
{
    public function extend(Tabs $tabs)
    {
        $tabs->group('advanced_information')
            ->add($this->options());
    }

    private function options()
    {
        if (! auth()->user()->hasAccess(['admin.options.create', 'admin.options.edit'])) {
            return;
        }

        return tap(new Tab('options', trans('option::options.tabs.product.options')), function (Tab $tab) {
            $tab->weight(35);

            $tab->fields([
                'options.*.name',
                'options.*.type',
                'options.*.values.*.label',
                'options.*.values.*.price',
                'options.*.values.*.price_type',
            ]);

            $tab->view('option::admin.products.tabs.options', [
                'globalOptions' => Option::globals()->get(),
            ]);
        });
    }
}
