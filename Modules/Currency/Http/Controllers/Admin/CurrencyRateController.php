<?php

namespace Modules\Currency\Http\Controllers\Admin;

use Modules\Admin\Traits\HasCrudActions;
use Modules\Currency\Entities\CurrencyRate;
use Modules\Currency\Services\CurrencyRateExchanger;
use Modules\Currency\Http\Requests\UpdateCurrencyRateRequest;

class CurrencyRateController
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = CurrencyRate::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'currency::currency_rates.currency_rate';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'currency::admin.currency_rates';

    /**
     * Form requests for the resource.
     *
     * @var array
     */
    protected $validation = UpdateCurrencyRateRequest::class;

    /**
     * Refresh currency rates.
     *
     * @param \Modules\Currency\Services\CurrencyRateExchanger $exchanger
     * @return \Illuminate\Http\Response
     */
    public function refresh(CurrencyRateExchanger $exchanger)
    {
        if (is_null(setting('currency_rate_exchange_service'))) {
            abort(400, trans('currency::messages.exchange_service_is_not_configured'));
        }

        CurrencyRate::refreshRates($exchanger);
    }
}
