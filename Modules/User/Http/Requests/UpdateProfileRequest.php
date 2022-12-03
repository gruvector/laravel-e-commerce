<?php

namespace Modules\User\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Core\Http\Requests\Request;

class UpdateProfileRequest extends Request
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
            'email' => ['required', Rule::unique('users')->ignore($this->email, 'email')],
            'phone' => ['required'],
            'first_name' => ['required'],
            'last_name' => ['required'],
            'password' => ['nullable', 'confirmed', 'min:6'],
        ];
    }

    /**
     * Hash the user password against the bcrypt algorithm.
     *
     * @return $this|null
     */
    public function bcryptPassword()
    {
        if ($this->filled('password')) {
            return $this->merge(['password' => bcrypt($this->password)]);
        }

        unset($this['password']);
    }
}
