<?php

namespace Modules\User\Admin;

use Modules\Admin\Ui\Tab;
use Modules\Admin\Ui\Tabs;
use Modules\User\Repositories\Permission;

class RoleTabs extends Tabs
{
    public function make()
    {
        $this->group('role_information', trans('user::roles.tabs.role_information'))
            ->active()
            ->add($this->general())
            ->add($this->permissions());
    }

    private function general()
    {
        return tap(new Tab('general', trans('user::roles.tabs.general')), function (Tab $tab) {
            $tab->active();
            $tab->weight(10);
            $tab->fields('name');
            $tab->view('user::admin.roles.tabs.general');
        });
    }

    private function permissions()
    {
        return tap(new Tab('permissions', trans('user::roles.tabs.permissions')), function (Tab $tab) {
            $tab->weight(20);

            $tab->view(function ($data) {
                return view('user::admin.partials.permissions.index', [
                    'entity' => $data['role'],
                    'permissions' => Permission::all(),
                ]);
            });
        });
    }
}
