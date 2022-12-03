<?php

namespace Modules\Admin\Http\Controllers\Admin;

use Modules\Order\Entities\Order;

class SalesAnalyticsController
{
    /**
     * Display a listing of the resource.
     *
     * @param \Modules\Order\Entities\Order $order
     * @return \Illuminate\Http\Response
     */
    public function index(Order $order)
    {
        return response()->json([
            'labels' => trans('admin::dashboard.sales_analytics.day_names'),
            'data' => $order->salesAnalytics(),
        ]);
    }
}
