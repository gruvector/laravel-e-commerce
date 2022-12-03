<?php

namespace Modules\Currency\Admin;

use Modules\Admin\Ui\Tab;
use Modules\Admin\Ui\Tabs;

class CurrencyRateTabs extends Tabs
{
    /**
     * Make new tabs with groups.
     *
     * @return void
     */
    public function make()
    {
        $this->group('currency_rate_information', trans('currency::currency_rates.tabs.group.currency_rate_information'))
            ->active()
            ->add($this->general());
    }

    private function general()
    {
        return tap(new Tab('general', trans('currency::currency_rates.tabs.general')), function (Tab $tab) {
            $tab->active();
            $tab->weight(5);
            $tab->fields(['rate']);
            $tab->view('currency::admin.currency_rates.tabs.general');
        });
    }
}
