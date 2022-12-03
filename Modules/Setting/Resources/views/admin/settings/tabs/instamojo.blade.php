<div class="row">
    <div class="col-md-8">
        {{ Form::checkbox('instamojo_enabled', trans('setting::attributes.instamojo_enabled'), trans('setting::settings.form.enable_instamojo'), $errors, $settings) }}
        {{ Form::text('translatable[instamojo_label]', trans('setting::attributes.instamojo_label'), $errors, $settings, ['required' => true]) }}
        {{ Form::textarea('translatable[instamojo_description]', trans('setting::attributes.instamojo_description'), $errors, $settings, ['rows' => 3, 'required' => true]) }}
        {{ Form::checkbox('instamojo_test_mode', trans('setting::attributes.instamojo_test_mode'), trans('setting::settings.form.use_sandbox_for_test_payments'), $errors, $settings) }}

        <div class="{{ old('instamojo_enabled', array_get($settings, 'instamojo_enabled')) ? '' : 'hide' }}" id="instamojo-fields">
            {{ Form::text('instamojo_api_key', trans('setting::attributes.instamojo_api_key'), $errors, $settings, ['required' => true]) }}
            {{ Form::password('instamojo_auth_token', trans('setting::attributes.instamojo_auth_token'), $errors, $settings, ['required' => true]) }}
        </div>
    </div>
</div>
