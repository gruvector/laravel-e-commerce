<?php

namespace Modules\Coupon\Http\Requests;

use Modules\Core\Http\Requests\Request;

class SaveCouponRequest extends Request
{
    /**
     * Available attributes.
     *
     * @var string
     */
    protected $availableAttributes = 'coupon::attributes';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'code' => 'required',
            'is_percent' => 'required|boolean',
            'value' => 'nullable|numeric|min:0|max:99999999999999',
            'free_shipping' => 'required|boolean',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'is_active' => 'required|boolean',
            'minimum_spend' => 'nullable|numeric|min:0|max:99999999999999',
            'maximum_spend' => 'nullable|numeric|min:0|max:99999999999999',
            'usage_limit_per_coupon' => 'nullable|numeric|min:0|max:4294967295',
            'usage_limit_per_customer' => 'nullable|numeric|min:0|max:4294967295',
        ];
    }
}
