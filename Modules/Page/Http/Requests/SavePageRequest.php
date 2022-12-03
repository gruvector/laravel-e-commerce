<?php

namespace Modules\Page\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Page\Entities\Page;
use Modules\Core\Http\Requests\Request;

class SavePageRequest extends Request
{
    /**
     * Available attributes.
     *
     * @var array
     */
    protected $availableAttributes = 'page::attributes';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'slug' => $this->getSlugRules(),
            'name' => 'required',
            'body' => 'required',
            'is_active' => 'required|boolean',
        ];
    }

    private function getSlugRules()
    {
        $rules = $this->route()->getName() === 'admin.pages.update'
            ? ['required']
            : ['sometimes'];

        $slug = Page::withoutGlobalScope('active')->where('id', $this->id)->value('slug');

        $rules[] = Rule::unique('pages', 'slug')->ignore($slug, 'slug');

        return $rules;
    }
}
