<?php

namespace App\Http\Requests\Device;

use Illuminate\Foundation\Http\FormRequest;

class CreatePlanAPIRequest extends FormRequest
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
            'name' => ['nullable', 'string'],
            'decription' => ['nullable', 'string'],
            'code' => ['nullable', 'string'],
            'validity_in_days' => ['nullable', 'string'],
            'minimum_user' => ['nullable', 'integer'],
            'maximum_user' => ['nullable', 'integer'],
            'per_user_amount' => ['nullable', 'integer'],
            'markup' => ['nullable', 'integer'],
            'discount' => ['nullable', 'integer'],
            'valid_from' => ['nullable'],
            'valid_to' => ['nullable'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
