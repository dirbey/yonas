<?php

namespace App\Repositories;

use App\Models\Plan;

class PlanRepository extends BaseRepository
{
    /**
     * @var string[]
     */
    protected $fieldSearchable = [
        'id',
        'name',
        'decription',
        'code',
        'validity_in_days',
        'minimum_user',
        'maximum_user',
        'per_user_amount',
        'markup',
        'discount',
        'valid_from',
        'valid_to',
        'is_active',
        'created_at',
        'updated_at',
        'updated_by',
        'added_by',
    ];

    /**
     * @return string[]
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * @return string
     */
    public function model(): string
    {
        return Plan::class;
    }

    /**
     * @return string[]
     */
    public function getAvailableRelations(): array
    {
        return ['addedByUser', 'updatedByUser'];
    }
}
