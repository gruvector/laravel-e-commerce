<?php

namespace Modules\Coupon\Exceptions;

use Exception;

class CouponAlreadyAppliedException extends Exception
{
    /**
     * Render the exception into an HTTP response.
     *
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return response()->json([
            'message' => trans('coupon::messages.already_applied'),
        ], 403);
    }
}
