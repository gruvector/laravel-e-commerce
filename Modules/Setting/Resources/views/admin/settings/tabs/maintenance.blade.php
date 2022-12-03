<div class="row">
    <div class="col-md-8">
        {{ Form::checkbox('maintenance_mode', trans('setting::attributes.maintenance_mode'), trans('setting::settings.form.put_the_application_into_maintenance_mode'), $errors, $settings) }}
    </div>
</div>
