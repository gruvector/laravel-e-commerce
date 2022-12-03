<?php

namespace Modules\Slider\Http\Requests;

use Modules\Core\Http\Requests\Request;

class SaveSliderOptionRequest extends Request
{
    /**
     * Available attributes.
     *
     * @var string
     */
    protected $moduleAttributes = 'slider::attributes';

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
