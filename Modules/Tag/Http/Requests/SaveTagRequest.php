<?php

namespace Modules\Tag\Http\Requests;

use Modules\Core\Http\Requests\Request;

class SaveTagRequest extends Request
{
    /**
     * Available attributes.
     *
     * @var string
     */
    protected $availableAttributes = 'tag::attributes';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
