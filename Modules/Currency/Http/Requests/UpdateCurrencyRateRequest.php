<?php

namespace Modules\Currency\Http\Requests;

use Modules\Core\Http\Requests\Request;

class UpdateCurrencyRateRequest extends Request
{
    /**
     * Available attributes.
     *
     * @var string
     */
    protected $availableAttributes = 'currency::attributes';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rate' => 'required|numeric|max:9999',
        ];
    }
}
