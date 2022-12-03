<?php

namespace Modules\Coupon\Exceptions;

use Exception;

class InapplicableCouponException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     *
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return response()->json([
            'message' => trans('coupon::messages.inapplicable'),
        ], 403);
    }
}
