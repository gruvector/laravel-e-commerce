<div class="row">
    <div class="col-md-8">
        <div class="box-content clearfix">
            {{ Form::text('translatable[store_name]', trans('setting::attributes.translatable.store_name'), $errors, $settings, ['required' => true]) }}
            {{ Form::text('translatable[store_tagline]', trans('setting::attributes.translatable.store_tagline'), $errors, $settings, ['rows' => 2]) }}
            {{ Form::text('store_email', trans('setting::attributes.store_email'), $errors, $settings, ['required' => true]) }}
            {{ Form::text('store_phone', trans('setting::attributes.store_phone'), $errors, $settings, ['required' => true]) }}
            {{ Form::text('store_address_1', trans('setting::attributes.store_address_1'), $errors, $settings) }}
            {{ Form::text('store_address_2', trans('setting::attributes.store_address_2'), $errors, $settings) }}
            {{ Form::text('store_city', trans('setting::attributes.store_city'), $errors, $settings) }}
            {{ Form::select('store_country', trans('setting::attributes.store_country'), $errors, $countries, $settings) }}

            <div class="store-state input">
                {{ Form::text('store_state', trans('setting::attributes.store_state'), $errors, $settings) }}
            </div>

            <div class="store-state select hide">
                {{ Form::select('store_state', trans('setting::attributes.store_state'), $errors, [], $settings) }}
            </div>

            {{ Form::text('store_zip', trans('setting::attributes.store_zip'), $errors, $settings) }}
        </div>

        <div class="box-content clearfix">
            <h4 class="section-title">{{ trans('setting::settings.form.privacy_settings') }}</h4>

            {{ Form::checkbox('store_phone_hide', trans('setting::attributes.store_phone_hide'), trans('setting::settings.form.hide_store_phone'), $errors, $settings) }}
            {{ Form::checkbox('store_email_hide', trans('setting::attributes.store_email_hide'), trans('setting::settings.form.hide_store_email'), $errors, $settings) }}
        </div>
    </div>
</div>
