<?php

namespace Modules\User\Http\Requests;

use Modules\Core\Http\Requests\Request;

class ResetCompleteRequest extends Request
{
    /**
     * Available attributes.
     *
     * @var string
     */
    protected $availableAttributes = 'user::attributes.users';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'new_password' => 'required|confirmed|min:6',
            'new_password_confirmation' => 'required',
        ];
    }
}
