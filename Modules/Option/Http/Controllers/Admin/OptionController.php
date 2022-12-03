<?php

namespace Modules\Option\Http\Controllers\Admin;

use Modules\Option\Entities\Option;
use Modules\Admin\Traits\HasCrudActions;
use Modules\Option\Http\Requests\SaveOptionRequest;

class OptionController
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Option::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'option::options.option';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'option::admin.options';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveOptionRequest::class;
}
