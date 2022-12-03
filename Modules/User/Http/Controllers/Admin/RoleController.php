<?php

namespace Modules\User\Http\Controllers\Admin;

use Modules\User\Entities\Role;
use Modules\Admin\Traits\HasCrudActions;
use Modules\User\Http\Requests\SaveRoleRequest;

class RoleController
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Role::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'user::roles.role';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'user::admin.roles';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveRoleRequest::class;
}
