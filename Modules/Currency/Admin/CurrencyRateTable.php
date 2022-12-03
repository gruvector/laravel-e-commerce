<?php

namespace Modules\Currency\Admin;

use Modules\Currency\Currency;
use Modules\Admin\Ui\AdminTable;

class CurrencyRateTable extends AdminTable
{
    /**
     * Raw columns that will not be escaped.
     *
     * @var array
     */
    protected $rawColumns = ['rate', 'updated_at'];

    /**
     * Make table response for the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function make()
    {
        return $this->newTable()
            ->editColumn('currency_name', function ($currencyRate) {
                return Currency::name($currencyRate->currency);
            })
            ->editColumn('updated_at', function ($currencyRate) {
                return view('admin::partials.table.date')->with('date', $currencyRate->updated_at);
            });
    }
}
