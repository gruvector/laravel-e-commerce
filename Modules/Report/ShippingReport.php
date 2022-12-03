<?php

namespace Modules\Report;

use Modules\Order\Entities\Order;
use Modules\Shipping\Facades\ShippingMethod;

class ShippingReport extends Report
{
    protected function view()
    {
        return 'report::admin.reports.shipping_report.index';
    }

    protected function data()
    {
        return [
            'shippingMethods' => ShippingMethod::all(),
        ];
    }

    public function query()
    {
        return Order::select('shipping_method')
            ->selectRaw('MIN(created_at) as start_date')
            ->selectRaw('MAX(created_at) as end_date')
            ->selectRaw('COUNT(*) as total_orders')
            ->selectRaw('SUM(shipping_cost) as total')
            ->when(request()->has('shipping_method'), function ($query) {
                $query->where('shipping_method', request('shipping_method'));
            })
            ->groupBy('shipping_method');
    }
}
