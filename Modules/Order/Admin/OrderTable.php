<?php

namespace Modules\Order\Admin;

use Modules\Admin\Ui\AdminTable;

class OrderTable extends AdminTable
{
    /**
     * Make table response for the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function make()
    {
        return $this->newTable()
            ->addColumn('customer_name', function ($order) {
                return $order->customer_full_name;
            })
            ->editColumn('total', function ($order) {
                return $order->total->format();
            })
            ->editColumn('status', function ($order) {
                return $order->status();
            });
    }
}
