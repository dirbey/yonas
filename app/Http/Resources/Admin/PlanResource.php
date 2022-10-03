<?php

namespace App\Http\Resources\Admin;

use App\Http\Resources\BaseAPIResource;
use Illuminate\Http\Request;

class PlanResource extends BaseAPIResource
{
    /**
     * @param Request $request
     *
     * @return array
     */
    public function toArray($request): array
    {
        $fieldsFilter = $request->get('fields');
        if (!empty($fieldsFilter) || $request->get('include')) {
            return $this->resource->toArray();
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'decription' => $this->decription,
            'code' => $this->code,
            'validity_in_days' => $this->validity_in_days,
            'minimum_user' => $this->minimum_user,
            'maximum_user' => $this->maximum_user,
            'per_user_amount' => $this->per_user_amount,
            'markup' => $this->markup,
            'discount' => $this->discount,
            'valid_from' => $this->valid_from,
            'valid_to' => $this->valid_to,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'added_by' => $this->added_by,
        ];
    }
}
