<div class="permission-row">
    <div class="row">
        <div class="col-md-5 col-sm-4">
            <span class="permission-label">{{ trans($permissionLabel) }}</sapn>
        </div>

        <div class="col-md-7 col-sm-8">
            <div class="row">
                <div class="radio-btn clearfix">

                    @if (! is_null($entity))
                        @php
                            $permissionValue = old('permissions')["{$group}.{$permissionAction}"] ?? permission_value($entity->permissions ?: [], "{$group}.{$permissionAction}")
                        @endphp
                    @endif

                    <div class="radio">
                        <input type="radio" value="0" id="{{ "{$group}-{$permissionAction}" }}-inherit" name="permissions[{{ "{$group}.{$permissionAction}" }}]" class="permission-inherit" {{ isset($permissionValue) && $permissionValue == 0 ? 'checked' : '' }}>

                        <label for="{{ "{$group}-{$permissionAction}" }}-inherit">{{ trans('user::roles.permissions.inherit') }}</label>
                    </div>

                    <div class="radio">
                        <input type="radio" value="-1" id="{{ "{$group}-{$permissionAction}" }}-deny" name="permissions[{{ "{$group}.{$permissionAction}" }}]" class="permission-deny" {{ isset($permissionValue) && $permissionValue == -1 ? 'checked' : '' }}>

                        <label for="{{ "{$group}-{$permissionAction}" }}-deny">{{ trans('user::roles.permissions.deny') }}</label>
                    </div>

                    <div class="radio">
                        <input type="radio" value="1" id="{{ "{$group}-{$permissionAction}" }}-allow" name="permissions[{{ "{$group}.{$permissionAction}" }}]" class="permission-allow" {{ isset($permissionValue) && $permissionValue == 1 ? 'checked' : '' }}>

                        <label for="{{ "{$group}-{$permissionAction}" }}-allow">{{ trans('user::roles.permissions.allow') }}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
