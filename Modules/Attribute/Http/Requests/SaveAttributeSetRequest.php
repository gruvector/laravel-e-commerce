<?php

namespace Modules\Attribute\Http\Requests;

use Modules\Core\Http\Requests\Request;

class SaveAttributeSetRequest extends Request
{
    /**
     * Available attributes.
     *
     * @var string
     */
    protected $availableAttributes = 'attribute::attributes.attribute_sets';

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
