<?php

namespace Modules\Review\Admin;

use Modules\Admin\Ui\Tab;
use Modules\Admin\Ui\Tabs;

class ReviewTabs extends Tabs
{
    /**
     * Make new tabs with groups.
     *
     * @return void
     */
    public function make()
    {
        $this->group('review_information', trans('review::reviews.tabs.group.review_information'))
            ->active()
            ->add($this->general());
    }

    private function general()
    {
        return tap(new Tab('review', trans('review::reviews.tabs.general')), function (Tab $tab) {
            $tab->active();
            $tab->weight(5);
            $tab->fields(['rating', 'reviewer_name', 'comment', 'is_approved']);
            $tab->view('review::admin.reviews.tabs.general');
        });
    }
}
