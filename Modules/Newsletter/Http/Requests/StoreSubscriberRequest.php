<?php

namespace Modules\Newsletter\Http\Requests;

use Modules\Core\Http\Requests\Request;

class StoreSubscriberRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required', 'email'],
        ];
    }
}
