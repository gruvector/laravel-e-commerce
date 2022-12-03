<?php

namespace Modules\Brand\Http\Controllers\Admin;

use Modules\Brand\Entities\Brand;
use Modules\Admin\Traits\HasCrudActions;
use Modules\Brand\Http\Requests\SaveBrandRequest;

class BrandController
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Brand::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'brand::brands.brand';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'brand::admin.brands';

    /**
     * Form requests for the resource.
     *
     * @var array
     */
    protected $validation = SaveBrandRequest::class;
}
