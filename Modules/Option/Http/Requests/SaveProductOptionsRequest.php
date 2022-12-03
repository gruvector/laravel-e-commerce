<?php

namespace Modules\Option\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Option\Entities\Option;
use Modules\Core\Http\Requests\Request;

class SaveProductOptionsRequest extends Request
{
    /**
     * Available attributes.
     *
     * @var string
     */
    protected $availableAttributes = 'option::attributes';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'options.*.name' => 'required_with:options.*.type',
            'options.*.type' => ['nullable', 'required_with:options.*.name', Rule::in(Option::TYPES)],
            'options.*.is_required' => ['required_with:options.*.name', 'boolean'],
            'options.*.values.*.label' => 'required_if:options.*.type,dropdown,checkbox,checkbox_custom,radio,radio_custom,multiple_select',
            'options.*.values.*.price' => 'nullable|numeric|min:0|max:99999999999999',
            'options.*.values.*.price_type' => ['required', Rule::in(['fixed', 'percent'])],
        ];
    }
}
