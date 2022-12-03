<?php

namespace Modules\Media\Http\Requests;

use Modules\Core\Http\Requests\Request;

class UploadMediaRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => 'file',
        ];
    }
}
