<?php

namespace Modules\Brand\Admin;

use Modules\Admin\Ui\Tab;
use Modules\Admin\Ui\Tabs;

class BrandTabs extends Tabs
{
    public function make()
    {
        $this->group('brand_information', trans('brand::brands.tabs.group.brand_information'))
            ->active()
            ->add($this->general())
            ->add($this->images())
            ->add($this->seo());
    }

    private function general()
    {
        return tap(new Tab('general', trans('brand::brands.tabs.general')), function (Tab $tab) {
            $tab->active();
            $tab->weight(5);
            $tab->fields(['name']);
            $tab->view('brand::admin.brands.tabs.general');
        });
    }

    private function images()
    {
        if (! auth()->user()->hasAccess('admin.media.index')) {
            return;
        }

        return tap(new Tab('images', trans('brand::brands.tabs.images')), function (Tab $tab) {
            $tab->weight(10);
            $tab->view('brand::admin.brands.tabs.images');
        });
    }

    private function seo()
    {
        return tap(new Tab('seo', trans('brand::brands.tabs.seo')), function (Tab $tab) {
            $tab->weight(15);
            $tab->fields(['slug']);
            $tab->view('brand::admin.brands.tabs.seo');
        });
    }
}
