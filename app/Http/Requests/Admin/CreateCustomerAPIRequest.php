<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerAPIRequest extends FormRequest
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
            'first_name' => ['nullable', 'string'],
            'last_name' => ['nullable', 'string'],
            'profile' => ['nullable', 'string'],
            'contact_number' => ['nullable', 'string'],
            'email' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
