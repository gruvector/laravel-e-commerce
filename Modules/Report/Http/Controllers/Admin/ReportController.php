<?php

namespace Modules\Report\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Modules\Report\TaxReport;
use Modules\Report\SalesReport;
use Modules\Report\SearchReport;
use Modules\Report\CouponsReport;
use Modules\Report\ShippingReport;
use Modules\Report\ProductsViewReport;
use Modules\Report\ProductsStockReport;
use Modules\Report\TaxedProductsReport;
use Modules\Report\CustomersOrderReport;
use Modules\Report\TaggedProductsReport;
use Modules\Report\BrandedProductsReport;
use Modules\Report\ProductsPurchaseReport;
use Modules\Report\CategorizedProductsReport;

class ReportController
{
    /**
     * Array of available reports.
     *
     * @var array
     */
    private $reports = [
        'coupons_report' => CouponsReport::class,
        'customers_order_report' => CustomersOrderReport::class,
        'products_purchase_report' => ProductsPurchaseReport::class,
        'products_stock_report' => ProductsStockReport::class,
        'products_view_report' => ProductsViewReport::class,
        'branded_products_report' => BrandedProductsReport::class,
        'categorized_products_report' => CategorizedProductsReport::class,
        'taxed_products_report' => TaxedProductsReport::class,
        'tagged_products_report' => TaggedProductsReport::class,
        'sales_report' => SalesReport::class,
        'search_report' => SearchReport::class,
        'shipping_report' => ShippingReport::class,
        'tax_report' => TaxReport::class,
    ];

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $type = $request->query('type');

        if (! $this->reportTypeExists($type)) {
            return redirect()->route('admin.reports.index', ['type' => 'coupons_report']);
        }

        return $this->report($type)->render($request);
    }

    /**
     * Determine if the report type exists.
     *
     * @param string $type
     * @return bool
     */
    private function reportTypeExists($type)
    {
        return array_key_exists($type, $this->reports);
    }

    /**
     * Returns a new instance of the given type of report.
     *
     * @param string $type
     * @return mixed
     */
    private function report($type)
    {
        return new $this->reports[$type];
    }
}
