<div class="row">
    <div class="col-md-8">
        {{ Form::checkbox('flat_rate_enabled', trans('setting::attributes.flat_rate_enabled'), trans('setting::settings.form.enable_flat_rate'), $errors, $settings) }}
        {{ Form::text('translatable[flat_rate_label]', trans('setting::attributes.translatable.flat_rate_label'), $errors, $settings, ['required' => true]) }}
        {{ Form::number('flat_rate_cost', trans('setting::attributes.flat_rate_cost'), $errors, $settings, ['min' => 0, 'required' => true]) }}
    </div>
</div>
