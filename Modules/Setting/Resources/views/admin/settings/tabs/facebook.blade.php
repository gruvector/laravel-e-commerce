<div class="row">
    <div class="col-md-8">
        {{ Form::checkbox('facebook_login_enabled', trans('setting::attributes.facebook_login_enabled'), trans('setting::settings.form.enable_facebook_login'), $errors, $settings) }}

        <div class="{{ old('facebook_login_enabled', array_get($settings, 'facebook_login_enabled')) ? '' : 'hide' }}" id="facebook-login-fields">
            {{ Form::text('facebook_login_app_id', trans('setting::attributes.facebook_login_app_id'), $errors, $settings, ['required' => true]) }}
            {{ Form::password('facebook_login_app_secret', trans('setting::attributes.facebook_login_app_secret'), $errors, $settings, ['required' => true]) }}
        </div>
    </div>
</div>
