<div class="row">
    <div class="col-md-8">
        {{ Form::checkbox('razorpay_enabled', trans('setting::attributes.razorpay_enabled'), trans('setting::settings.form.enable_razorpay'), $errors, $settings) }}
        {{ Form::text('translatable[razorpay_label]', trans('setting::attributes.razorpay_label'), $errors, $settings, ['required' => true]) }}
        {{ Form::textarea('translatable[razorpay_description]', trans('setting::attributes.razorpay_description'), $errors, $settings, ['rows' => 3, 'required' => true]) }}

        <div class="{{ old('razorpay_enabled', array_get($settings, 'razorpay_enabled')) ? '' : 'hide' }}" id="razorpay-fields">
            {{ Form::text('razorpay_key_id', trans('setting::attributes.razorpay_key_id'), $errors, $settings, ['required' => true]) }}
            {{ Form::password('razorpay_key_secret', trans('setting::attributes.razorpay_key_secret'), $errors, $settings, ['required' => true]) }}
        </div>
    </div>
</div>
