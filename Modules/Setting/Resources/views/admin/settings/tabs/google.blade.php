<div class="row">
    <div class="col-md-8">
        {{ Form::checkbox('google_login_enabled', trans('setting::attributes.google_login_enabled'), trans('setting::settings.form.enable_google_login'), $errors, $settings) }}

        <div class="{{ old('google_login_enabled', array_get($settings, 'google_login_enabled')) ? '' : 'hide' }}" id="google-login-fields">
            {{ Form::text('google_login_client_id', trans('setting::attributes.google_login_client_id'), $errors, $settings, ['required' => true]) }}
            {{ Form::password('google_login_client_secret', trans('setting::attributes.google_login_client_secret'), $errors, $settings, ['required' => true]) }}
        </div>
    </div>
</div>
