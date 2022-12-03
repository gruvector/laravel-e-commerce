<?php

namespace Modules\Attribute\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Core\Http\Requests\Request;
use Modules\Attribute\Entities\Attribute;

class SaveAttributeRequest extends Request
{
    /**
     * Available attributes.
     *
     * @var string
     */
    protected $availableAttributes = 'attribute::attributes.attributes';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'attribute_set_id' => ['required', Rule::exists('attribute_sets', 'id')],
            'name' => 'required',
            'slug' => $this->getSlugRules(),
            'is_filterable' => 'required|boolean',
        ];
    }

    private function getSlugRules()
    {
        $rules = $this->route()->getName() === 'admin.attributes.update'
            ? ['required']
            : ['sometimes'];

        $slug = Attribute::where('id', $this->id)->value('slug');

        $rules[] = Rule::unique('attributes', 'slug')->ignore($slug, 'slug');

        return $rules;
    }

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    public function validationData()
    {
        return request()->merge([
            'values' => $this->filter($this->values ?? []),
        ])->all();
    }

    /**
     * Filter attribute values.
     *
     * @param array $values
     * @return array
     */
    private function filter($values = [])
    {
        return array_filter($values, function ($value) {
            return ! is_null($value['value']);
        });
    }
}
