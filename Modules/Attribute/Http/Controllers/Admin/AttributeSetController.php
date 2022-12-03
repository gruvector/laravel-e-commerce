<?php

namespace Modules\Attribute\Http\Controllers\Admin;

use Modules\Admin\Traits\HasCrudActions;
use Modules\Attribute\Entities\AttributeSet;
use Modules\Attribute\Http\Requests\SaveAttributeSetRequest;

class AttributeSetController
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = AttributeSet::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'attribute::attribute_sets.attribute_set';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'attribute::admin.attribute_sets';

    /**
     * Form requests for the resource.
     *
     * @var array
     */
    protected $validation = SaveAttributeSetRequest::class;
}
