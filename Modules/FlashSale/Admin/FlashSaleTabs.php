<?php

namespace Modules\FlashSale\Admin;

use Modules\Admin\Ui\Tab;
use Modules\Admin\Ui\Tabs;

class FlashSaleTabs extends Tabs
{
    /**
     * Indicate that submit button should add offset class.
     *
     * @var bool
     */
    protected $buttonOffset = false;

    public function make()
    {
        $this->group('flash_sale_information', trans('flashsale::flash_sales.tabs.group.flash_sale_information'))
            ->active()
            ->add($this->products())
            ->add($this->settings());
    }

    private function products()
    {
        return tap(new Tab('products', trans('flashsale::flash_sales.tabs.products')), function (Tab $tab) {
            $tab->active();
            $tab->weight(5);

            $tab->fields([
                'products.*.product_id',
                'products.*.end_date',
                'products.*.price',
                'products.*.quantity',
            ]);

            $tab->view('flashsale::admin.flash_sales.tabs.products');
        });
    }

    private function settings()
    {
        return tap(new Tab('settings', trans('flashsale::flash_sales.tabs.settings')), function (Tab $tab) {
            $tab->weight(10);
            $tab->fields(['campaign_name']);
            $tab->view('flashsale::admin.flash_sales.tabs.settings');
        });
    }
}
