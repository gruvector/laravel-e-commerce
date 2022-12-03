<?php

namespace Modules\Coupon\Admin;

use Modules\Admin\Ui\Tab;
use Modules\Admin\Ui\Tabs;
use Modules\Coupon\Entities\Coupon;
use Modules\Category\Entities\Category;

class CouponTabs extends Tabs
{
    public function make()
    {
        $this->group('coupon_information', trans('coupon::coupons.tabs.group.coupon_information'))
            ->active()
            ->add($this->general())
            ->add($this->usageRestrictions())
            ->add($this->usageLimits());
    }

    public function general()
    {
        return tap(new Tab('general', trans('coupon::coupons.tabs.general')), function (Tab $tab) {
            $tab->active();
            $tab->weight(5);

            $tab->fields([
                'name',
                'code',
                'is_percent',
                'value',
                'free_shipping',
                'start_date',
                'end_date',
                'is_active',
            ]);

            $tab->view('coupon::admin.coupons.tabs.general');
        });
    }

    public function usageRestrictions()
    {
        return tap(new Tab('usage_restrictions', trans('coupon::coupons.tabs.usage_restrictions')), function (Tab $tab) {
            $tab->weight(10);
            $tab->fields(['minimum_spend']);

            $coupon = Coupon::withoutGlobalScope('active')->findOrNew(request('id'));

            $tab->view('coupon::admin.coupons.tabs.usage_restrictions', [
                'products' => $coupon->productList(),
                'excludeProducts' => $coupon->excludeProductList(),
                'categories' => Category::treeList(),
            ]);
        });
    }

    private function usageLimits()
    {
        return tap(new Tab('usage_limits', trans('coupon::coupons.tabs.usage_limits')), function (Tab $tab) {
            $tab->weight(15);
            $tab->fields(['usage_limit_per_coupon', 'usage_limit_per_customer']);
            $tab->view('coupon::admin.coupons.tabs.usage_limits');
        });
    }
}
