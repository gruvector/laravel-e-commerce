<?php

namespace Modules\Report;

use Modules\Coupon\Entities\Coupon;

class CouponsReport extends Report
{
    protected $date = 'orders.created_at';

    protected function view()
    {
        return 'report::admin.reports.coupons_report.index';
    }

    protected function query()
    {
        return Coupon::withoutGlobalScope('active')
            ->select('coupons.id', 'code')
            ->join('orders', 'coupons.id', '=', 'orders.coupon_id')
            ->selectRaw('MIN(orders.created_at) as start_date')
            ->selectRaw('MAX(orders.created_at) as end_date')
            ->selectRaw('COUNT(*) as total_orders')
            ->selectRaw('SUM(orders.discount) as total')
            ->when(request()->has('coupon_code'), function ($query) {
                $query->where('code', request('coupon_code'));
            })
            ->groupBy(['coupons.id', 'coupons.code']);
    }
}
