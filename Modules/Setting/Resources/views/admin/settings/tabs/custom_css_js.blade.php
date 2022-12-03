<div class="row">
    <div class="col-md-8">
        {{ Form::textarea('custom_header_assets', trans('setting::attributes.custom_header_assets'), $errors, $settings) }}
        {{ Form::textarea('custom_footer_assets', trans('setting::attributes.custom_footer_assets'), $errors, $settings) }}
    </div>
</div>
