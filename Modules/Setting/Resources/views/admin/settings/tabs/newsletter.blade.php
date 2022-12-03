<div class="row">
    <div class="col-md-8">
        {{ Form::checkbox('newsletter_enabled', trans('setting::attributes.newsletter_enabled'), trans('setting::settings.form.allow_customers_to_subscribe'), $errors, $settings) }}
        {{ Form::password('mailchimp_api_key', trans('setting::attributes.mailchimp_api_key'), $errors, $settings) }}
        {{ Form::text('mailchimp_list_id', trans('setting::attributes.mailchimp_list_id'), $errors, $settings) }}
    </div>
</div>
