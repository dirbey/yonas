<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FileUploadAPIRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'files' => ['required'],
            'files.*' => ['mimes:png,jpeg,jpg,gif,pdf,doc,docx,msword,xls,xlsx,xla,xlt,json,exe,dll,bat,msi', 'max:51200'],
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'files.*.max' => 'The file size must not be greater than 50 mb',
        ];
    }
}
