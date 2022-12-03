<?php

namespace Modules\Page\Admin;

use Modules\Admin\Ui\Tab;
use Modules\Admin\Ui\Tabs;

class PageTabs extends Tabs
{
    public function make()
    {
        $this->group('page_information', trans('page::pages.tabs.group.page_information'))
            ->active()
            ->add($this->general())
            ->add($this->seo());
    }

    private function general()
    {
        return tap(new Tab('general', trans('page::pages.tabs.general')), function (Tab $tab) {
            $tab->active();
            $tab->weight(5);
            $tab->fields(['title', 'body', 'is_active', 'slug']);
            $tab->view('page::admin.pages.tabs.general');
        });
    }

    private function seo()
    {
        return tap(new Tab('seo', trans('page::pages.tabs.seo')), function (Tab $tab) {
            $tab->weight(10);
            $tab->view('page::admin.pages.tabs.seo');
        });
    }
}
