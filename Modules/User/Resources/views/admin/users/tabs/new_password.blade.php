<div class="row">
    <div class="col-md-8">
        {{ Form::password('password', trans('user::attributes.users.new_password'), $errors) }}
        {{ Form::password('password_confirmation', trans('user::attributes.users.confirm_new_password'), $errors) }}
    </div>

    <div class="col-md-4">
        <h4>{{ trans('user::users.or_reset_password') }}</h4>

        <a href="{{ route('admin.users.reset_password', $user) }}" class="btn btn-primary btn-reset-password" data-loading>
            {{ trans('user::users.send_reset_password_email') }}
        </a>
    </div>
</div>
