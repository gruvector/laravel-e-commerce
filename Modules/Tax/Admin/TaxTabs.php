<?php

namespace Modules\Tax\Admin;

use Modules\Admin\Ui\Tab;
use Modules\Admin\Ui\Tabs;
use Modules\Support\Country;

class TaxTabs extends Tabs
{
    public function make()
    {
        $this->group('tax_information', trans('tax::taxes.tabs.group.tax_information'))
            ->active()
            ->add($this->general())
            ->add($this->rates());
    }

    private function general()
    {
        return tap(new Tab('general', trans('tax::taxes.tabs.general')), function (Tab $tab) {
            $tab->active();
            $tab->weight(5);
            $tab->fields(['name']);
            $tab->view('tax::admin.taxes.tabs.general');
        });
    }

    private function rates()
    {
        return tap(new Tab('rates', trans('tax::taxes.tabs.rates')), function (Tab $tab) {
            $tab->weight(10);
            $tab->fields(['name', 'rates.*.name', 'rates.*.rate']);
            $tab->view('tax::admin.taxes.tabs.rates', [
                'countries' => Country::supported(),
            ]);
        });
    }
}
