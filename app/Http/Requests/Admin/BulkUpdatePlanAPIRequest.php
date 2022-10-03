<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BulkUpdatePlanAPIRequest extends FormRequest
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
            'data.*.name' => ['nullable', 'string'],
            'data.*.decription' => ['nullable', 'string'],
            'data.*.code' => ['nullable', 'string'],
            'data.*.validity_in_days' => ['nullable', 'string'],
            'data.*.minimum_user' => ['nullable', 'integer'],
            'data.*.maximum_user' => ['nullable', 'integer'],
            'data.*.per_user_amount' => ['nullable', 'integer'],
            'data.*.markup' => ['nullable', 'integer'],
            'data.*.discount' => ['nullable', 'integer'],
            'data.*.valid_from' => ['nullable'],
            'data.*.valid_to' => ['nullable'],
            'data.*.is_active' => ['nullable', 'boolean'],
        ];
    }
}
