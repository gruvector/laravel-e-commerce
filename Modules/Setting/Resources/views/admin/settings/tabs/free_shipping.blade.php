<div class="row">
    <div class="col-md-8">
        {{ Form::checkbox('free_shipping_enabled', trans('setting::attributes.free_shipping_enabled'), trans('setting::settings.form.enable_free_shipping'), $errors, $settings) }}
        {{ Form::text('translatable[free_shipping_label]', trans('setting::attributes.translatable.free_shipping_label'), $errors, $settings, ['required' => true]) }}
        {{ Form::number('free_shipping_min_amount', trans('setting::attributes.free_shipping_min_amount'), $errors, $settings) }}
    </div>
</div>
