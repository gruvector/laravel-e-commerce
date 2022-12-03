<div class="row">
    <div class="col-lg-9 col-md-12">
        <div class="btn-group permission-parent-actions pull-right">
            <button type="button" class="btn btn-default allow-all">{{ trans('user::roles.permissions.allow_all')}}</button>
            <button type="button" class="btn btn-default deny-all">{{ trans('user::roles.permissions.deny_all')}}</button>
            <button type="button" class="btn btn-default inherit-all">{{ trans('user::roles.permissions.inherit_all')}}</button>
        </div>
    </div>
</div>

@foreach ($permissions as $module => $modulePermissions)
    <div class="row">
        <div class="col-lg-9 col-md-12">
            <div class="col-md-12">
                <div class="row">
                    <div class="permission-parent-head clearfix">
                        <h3>{{ $module }}</h3>
                    </div>
                </div>
            </div>

            <div class="clearfix"></div>

            @foreach ($modulePermissions as $group => $groupPermissions)
                <div class="permission-group">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="permission-group-head">
                                <div class="row">
                                    <div class="col-md-4 col-sm-4">
                                        <h4>{{ $group }}</h4>
                                    </div>

                                    <div class="col-md-8 col-sm-8">
                                        <div class="btn-group permission-group-actions pull-right">
                                            <button type="button" class="btn btn-default allow-all">{{ trans('user::roles.permissions.allow_all')}}</button>
                                            <button type="button" class="btn btn-default deny-all">{{ trans('user::roles.permissions.deny_all')}}</button>
                                            <button type="button" class="btn btn-default inherit-all">{{ trans('user::roles.permissions.inherit_all')}}</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                @foreach ($groupPermissions as $permissionAction => $permissionLabel)
                                    @include('user::admin.partials.permissions.actions')
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endforeach
