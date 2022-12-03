<div class="row">
    <div class="col-md-8">
        {{ Form::checkbox('cod_enabled', trans('setting::attributes.cod_enabled'), trans('setting::settings.form.enable_cod'), $errors, $settings) }}
        {{ Form::text('translatable[cod_label]', trans('setting::attributes.translatable.cod_label'), $errors, $settings, ['required' => true]) }}
        {{ Form::textarea('translatable[cod_description]', trans('setting::attributes.translatable.cod_description'), $errors, $settings, ['rows' => 3, 'required' => true]) }}
    </div>
</div>
