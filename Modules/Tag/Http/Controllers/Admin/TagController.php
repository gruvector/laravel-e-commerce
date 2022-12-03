<?php

namespace Modules\Tag\Http\Controllers\Admin;

use Modules\Tag\Entities\Tag;
use Modules\Admin\Traits\HasCrudActions;
use Modules\Tag\Http\Requests\SaveTagRequest;

class TagController
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Tag::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'tag::tags.tag';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'tag::admin.tags';

    /**
     * Form requests for the resource.
     *
     * @var array
     */
    protected $validation = SaveTagRequest::class;
}
