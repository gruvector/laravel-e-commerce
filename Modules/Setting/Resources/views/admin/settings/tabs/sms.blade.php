<div class="row">
    <div class="col-md-8">
        <div class="box-content clearfix">
            {{ Form::text('sms_from', trans('setting::attributes.sms_from'), $errors, $settings) }}
            {{ Form::select('sms_service', trans('setting::attributes.sms_service'), $errors, $smsServices, $settings) }}

            @foreach ($smsServices as $service => $serviceName)
                <div class="sms-service hide" id="{{ $service }}-service">
                    @includeIf("setting::admin.settings.partials.sms_services.{$service}")
                </div>
            @endforeach
        </div>

        <div class="box-content clearfix">
            <h4 class="section-title">{{ trans('setting::settings.form.customer_notification_settings') }}</h4>

            {{ Form::checkbox('welcome_sms', trans('setting::attributes.welcome_sms'), trans('setting::settings.form.send_welcome_sms_after_registration'), $errors, $settings) }}
        </div>

        <div class="box-content clearfix">
            <h4 class="section-title">{{ trans('setting::settings.form.order_notification_settings') }}</h4>

            {{ Form::checkbox('new_order_admin_sms', trans('setting::attributes.new_order_admin_sms'), trans('setting::settings.form.send_new_order_notification_to_admin'), $errors, $settings) }}
            {{ Form::checkbox('new_order_sms', trans('setting::attributes.new_order_sms'), trans('setting::settings.form.send_new_order_notification_to_customer'), $errors, $settings) }}
            {{ Form::select('sms_order_statuses', trans('setting::attributes.sms_order_statuses'), $errors, $orderStatuses, $settings, ['class' => 'selectize prevent-creation', 'multiple' => true]) }}
        </div>
    </div>
</div>
