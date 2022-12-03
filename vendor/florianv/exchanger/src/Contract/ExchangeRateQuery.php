<?php

declare(strict_types=1);

/*
 * This file is part of Exchanger.
 *
 * (c) Florian Voutzinos <florian@voutzinos.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Exchanger\Contract;

/**
 * Contract for exchange rate queries.
 *
 * @author Florian Voutzinos <florian@voutzinos.com>
 */
interface ExchangeRateQuery
{
    /**
     * Gets the currency pair.
     *
     * @return CurrencyPair
     */
    public function getCurrencyPair(): CurrencyPair;

    /**
     * Gets an option by name.
     *
     * @param string $name    The option name
     * @param mixed  $default The default value if not found
     *
     * @return mixed
     */
    public function getOption($name, $default = null);
}
