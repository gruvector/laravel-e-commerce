<?php

namespace Modules\Account\Http\Requests;

use Modules\Core\Http\Requests\Request;

class SaveAddressRequest extends Request
{
    /**
     * Available attributes.
     *
     * @var string
     */
    protected $availableAttributes = 'account::attributes.addresses';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'address_1' => ['required'],
            'city' => ['required'],
            'zip' => ['required'],
            'country' => ['required'],
            'state' => ['required'],
        ];
    }
}
