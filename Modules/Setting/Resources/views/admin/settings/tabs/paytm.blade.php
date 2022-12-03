<div class="row">
    <div class="col-md-8">
        {{ Form::checkbox('paytm_enabled', trans('setting::attributes.paytm_enabled'), trans('setting::settings.form.enable_paytm'), $errors, $settings) }}
        {{ Form::text('translatable[paytm_label]', trans('setting::attributes.translatable.paytm_label'), $errors, $settings, ['required' => true]) }}
        {{ Form::textarea('translatable[paytm_description]', trans('setting::attributes.translatable.paytm_description'), $errors, $settings, ['rows' => 3, 'required' => true]) }}
        {{ Form::checkbox('paytm_test_mode', trans('setting::attributes.paytm_test_mode'), trans('setting::settings.form.use_sandbox_for_test_payments'), $errors, $settings) }}

        <div class="{{ old('paytm_enabled', array_get($settings, 'paytm_enabled')) ? '' : 'hide' }}" id="paytm-fields">
            {{ Form::text('paytm_merchant_id', trans('setting::attributes.paytm_merchant_id'), $errors, $settings, ['required' => true]) }}
            {{ Form::password('paytm_merchant_key', trans('setting::attributes.paytm_merchant_key'), $errors, $settings, ['required' => true]) }}
        </div>
    </div>
</div>
