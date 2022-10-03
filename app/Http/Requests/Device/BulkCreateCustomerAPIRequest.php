<?php

namespace App\Http\Requests\Device;

use Illuminate\Foundation\Http\FormRequest;

class BulkCreateCustomerAPIRequest extends FormRequest
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
            'data.*.first_name' => ['nullable', 'string'],
            'data.*.last_name' => ['nullable', 'string'],
            'data.*.profile' => ['nullable', 'string'],
            'data.*.contact_number' => ['nullable', 'string'],
            'data.*.email' => ['nullable', 'string'],
            'data.*.is_active' => ['nullable', 'boolean'],
        ];
    }
}
