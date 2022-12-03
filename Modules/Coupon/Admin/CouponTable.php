<?php

namespace Modules\Coupon\Admin;

use Modules\Admin\Ui\AdminTable;

class CouponTable extends AdminTable
{
    /**
     * Make table response for the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function make()
    {
        return $this->newTable()
            ->addColumn('discount', function ($coupon) {
                return $coupon->is_percent
                    ? "{$coupon->value}%"
                    : $coupon->value->format();
            });
    }
}
