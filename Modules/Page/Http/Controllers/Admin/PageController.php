<?php

namespace Modules\Page\Http\Controllers\Admin;

use Modules\Page\Entities\Page;
use Modules\Admin\Traits\HasCrudActions;
use Modules\Page\Http\Requests\SavePageRequest;

class PageController
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'page::pages.page';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'page::admin.pages';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SavePageRequest::class;
}
