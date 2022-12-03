<?php

namespace Modules\Tax\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Tax\Entities\TaxClass;
use Modules\Core\Http\Requests\Request;

class SaveTaxRequest extends Request
{
    /**
     * Available attributes.
     *
     * @var string
     */
    protected $availableAttributes = 'tax::attributes';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'label' => 'required',
            'based_on' => ['required', Rule::in([TaxClass::SHIPPING_ADDRESS, TaxClass::BILLING_ADDRESS, TaxClass::STORE_ADDRESS])],
            'rates.*.name' => 'required_with:rates.*.rate',
            'rates.*.rate' => ['required_with:rates.*.name', 'numeric', 'min:0', 'max:9999'],
        ];
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    public function validationData()
    {
        return request()->merge([
            'rates' => $this->filter($this->rates ?? []),
        ])->all();
    }

    /**
     * Filter tax rates.
     *
     * @param array $rates
     * @return array
     */
    private function filter($rates = [])
    {
        return array_filter($rates, function ($rate) {
            return ! is_null($rate['name']) || ! is_null($rate['rate']);
        });
    }
}
