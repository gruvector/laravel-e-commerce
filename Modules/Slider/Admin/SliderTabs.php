<?php

namespace Modules\Slider\Admin;

use Modules\Admin\Ui\Tab;
use Modules\Admin\Ui\Tabs;

class SliderTabs extends Tabs
{
    /**
     * Indicate that submit button should add offset class.
     *
     * @var bool
     */
    protected $buttonOffset = false;

    /**
     * Make new tabs with groups.
     *
     * @return void
     */
    public function make()
    {
        $this->group('slider_information', trans('slider::sliders.tabs.group.slider_information'))
            ->active()
            ->add($this->slides())
            ->add($this->settings());
    }

    private function slides()
    {
        return tap(new Tab('slides', trans('slider::sliders.tabs.slides')), function (Tab $tab) {
            $tab->active();
            $tab->weight(5);
            $tab->view('slider::admin.sliders.tabs.slides');
        });
    }

    private function settings()
    {
        return tap(new Tab('settings', trans('slider::sliders.tabs.settings')), function (Tab $tab) {
            $tab->weight(10);
            $tab->fields(['name']);
            $tab->view('slider::admin.sliders.tabs.settings');
        });
    }
}
