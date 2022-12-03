<div class="row">
    <div class="col-md-8">
		{{ Form::select('supported_currencies', trans('setting::attributes.supported_currencies'), $errors, $currencies, $settings, ['class' => 'selectize prevent-creation', 'required' => true, 'multiple' => true]) }}
        {{ Form::select('default_currency', trans('setting::attributes.default_currency'), $errors, $currencies, $settings, ['required' => true]) }}
        {{ Form::select('currency_rate_exchange_service', trans('setting::attributes.currency_rate_exchange_service'), $errors, $currencyRateExchangeServices, $settings) }}

		@foreach ($currencyRateExchangeServices as $service => $serviceName)
            <div class="currency-rate-exchange-service hide" id="{{ $service }}-service">
                @includeIf("setting::admin.settings.partials.currency_rate_exchange_services.{$service}")
            </div>
        @endforeach

        {{ Form::checkbox('auto_refresh_currency_rates', trans('setting::attributes.auto_refresh_currency_rates'), trans('setting::settings.form.enable_auto_refreshing_currency_rates'), $errors, $settings) }}

        <div class="{{ old('auto_refresh_currency_rates', array_get($settings, 'auto_refresh_currency_rates')) ? '' : 'hide' }}" id="auto-refresh-frequency-field">
            {{ Form::select('auto_refresh_currency_rate_frequency', trans('setting::attributes.auto_refresh_currency_rate_frequency'), $errors, trans('setting::settings.form.auto_refresh_currency_rate_frequencies'), $settings, ['required' => true]) }}
        </div>
    </div>
</div>
