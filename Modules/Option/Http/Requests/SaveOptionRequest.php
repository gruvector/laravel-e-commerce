<?php

namespace Modules\Option\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Option\Entities\Option;
use Modules\Core\Http\Requests\Request;

class SaveOptionRequest extends Request
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
            'name' => 'required',
            'type' => ['required', Rule::in(Option::TYPES)],
            'is_required' => 'required|boolean',
            'values.*.label' => 'required_if:options.*.type,dropdown,checkbox,checkbox_custom,radio,radio_custom,multiple_select',
            'values.*.price' => 'nullable|numeric|min:0|max:99999999999999',
            'values.*.price_type' => ['required', Rule::in(['fixed', 'percent'])],
        ];
    }

    public function validationData()
    {
        return request()->merge([
            'values' => $this->filter($this->values ?? []),
        ])->all();
    }

    private function filter($values = [])
    {
        return array_filter($values, function ($value) {
            if (! array_has($value, 'label')) {
                return true;
            }

            return ! is_null($value['label']);
        });
    }
}
