<?php

namespace Modules\Coupon\Exceptions;

use Exception;

class MinimumSpendException extends Exception
{
    /**
     * The amount that need to spend.
     *
     * @var \Modules\Support\Money
     */
    private $money;

    /**
     * Create a new instance of the exceptions
     *
     * @param \Modules\Support\Money $money
     */
    public function __construct($money)
    {
        $this->money = $money;
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return response()->json([
            'message' => trans('coupon::messages.minimum_spend', ['amount' => $this->money->format()]),
        ], 403);
    }
}
