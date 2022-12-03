<?php

namespace Modules\Attribute\Http\Controllers\Admin;

use Modules\Admin\Traits\HasCrudActions;
use Modules\Attribute\Entities\Attribute;
use Modules\Attribute\Http\Requests\SaveAttributeRequest;

class AttributeController
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Attribute::class;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['values'];

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'attribute::admin.attribute';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'attribute::admin.attributes';

    /**
     * Form requests for the resource.
     *
     * @var array
     */
    protected $validation = SaveAttributeRequest::class;
}
