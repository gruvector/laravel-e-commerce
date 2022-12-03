<?php

namespace Modules\Coupon\Exceptions;

use Exception;

class MaximumSpendException extends Exception
{
    /**
     * The maximum amount that is allowed.
     *
     * @var money
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
            'message' => trans('coupon::messages.maximum_spend', ['amount' => $this->money->format()]),
        ], 403);
    }
}
