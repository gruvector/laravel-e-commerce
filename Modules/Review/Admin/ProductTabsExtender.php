<?php

namespace Modules\Review\Admin;

use Modules\Admin\Ui\Tab;
use Modules\Admin\Ui\Tabs;

class ProductTabsExtender
{
    public function extend(Tabs $tabs)
    {
        $tabs->group('advanced_information')
            ->add($this->reviews());
    }

    private function reviews()
    {
        if (! request()->routeIs('admin.products.edit')) {
            return;
        }

        return tap(new Tab('reviews', trans('review::reviews.tabs.products.reviews')), function (Tab $tab) {
            $tab->weight(50);
            $tab->view('review::admin.products.tabs.reviews');
        });
    }
}
