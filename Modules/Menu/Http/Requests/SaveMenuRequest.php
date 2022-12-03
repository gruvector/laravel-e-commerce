<?php

namespace Modules\Menu\Http\Requests;

use Modules\Core\Http\Requests\Request;

class SaveMenuRequest extends Request
{
    /**
     * Available attributes.
     *
     * @var array
     */
    protected $availableAttributes = 'menu::attributes';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
        ];
    }
}
