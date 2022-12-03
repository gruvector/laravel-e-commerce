<div class="row">
    <div class="col-md-8">
        {{ Form::checkbox('local_pickup_enabled', trans('setting::attributes.local_pickup_enabled'), trans('setting::settings.form.enable_local_pickup'), $errors, $settings) }}
        {{ Form::text('translatable[local_pickup_label]', trans('setting::attributes.translatable.local_pickup_label'), $errors, $settings, ['required' => true]) }}
        {{ Form::number('local_pickup_cost', trans('setting::attributes.local_pickup_cost'), $errors, $settings, ['min' => 0, 'required' => true]) }}
    </div>
</div>
