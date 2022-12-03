<?php

namespace Modules\Currency\Console;

use Illuminate\Console\Command;
use Modules\Currency\Entities\CurrencyRate;
use Modules\Currency\Services\CurrencyRateExchanger;

class RefreshCurrencyRatesCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'currency:refresh-rates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refresh currency rates.';

    /**
     * The currency rate exchanger instance.
     *
     * @var \Modules\Currency\Services\CurrencyRateExchanger
     */
    private $exchanger;

    /**
     * Create a new command instance.
     *
     * @param \Modules\Currency\Services\CurrencyRateExchanger $exchanger
     * @return void
     */
    public function __construct(CurrencyRateExchanger $exchanger)
    {
        parent::__construct();

        $this->exchanger = $exchanger;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (is_null(setting('currency_rate_exchange_service'))) {
            return logger()->error('RefreshCurrencyRatesCommand: Currency rate exchange service is not configured.');
        }

        CurrencyRate::refreshRates($this->exchanger);
    }
}
