<?php

namespace Modules\FlashSale\Http\Controllers\Admin;

use Modules\Admin\Traits\HasCrudActions;
use Modules\FlashSale\Entities\FlashSale;
use Modules\FlashSale\Http\Requests\SaveFlashSaleRequest;

class FlashSaleController
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = FlashSale::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'flashsale::flash_sales.flash_sale';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'flashsale::admin.flash_sales';

    /**
     * Form requests for the resource.
     *
     * @var array
     */
    protected $validation = SaveFlashSaleRequest::class;
}
