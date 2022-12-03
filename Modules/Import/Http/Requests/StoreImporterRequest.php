<?php

namespace Modules\Import\Http\Requests;

use Illuminate\Validation\Rule;
use Modules\Core\Http\Requests\Request;

class StoreImporterRequest extends Request
{
    /**
     * Available attributes.
     *
     * @var string
     */
    protected $availableAttributes = 'import::attributes';

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'import_type' => ['required', Rule::in(['product'])],
            'csv_file' => ['required', 'file', 'mimes:csv,txt'],
        ];
    }
}
