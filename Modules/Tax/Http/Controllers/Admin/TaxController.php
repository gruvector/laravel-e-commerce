<?php

namespace Modules\Tax\Http\Controllers\Admin;

use Modules\Tax\Entities\TaxClass;
use Modules\Admin\Traits\HasCrudActions;
use Modules\Tax\Http\Requests\SaveTaxRequest;

class TaxController
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = TaxClass::class;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['taxRates'];

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'tax::taxes.tax';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'tax::admin.taxes';

    /**
     * Route prefix of the resource.
     *
     * @var string
     */
    protected $routePrefix = 'admin.taxes';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveTaxRequest::class;
}
