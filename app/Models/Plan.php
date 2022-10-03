<?php

namespace App\Models;

use App\Traits\HasRecordOwnerProperties;
use Illuminate\Database\Eloquent\Model as Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Plan extends Model
{
    use HasRecordOwnerProperties;
    use LogsActivity;

    /**
     * @var string
     */
    protected $table = 'plans';

    /**
     * @var string[]
     */
    protected $fillable = [
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
     * @var string[]
     */
    protected $casts = [
        'name' => 'string',
        'decription' => 'string',
        'code' => 'string',
        'validity_in_days' => 'string',
        'minimum_user' => 'integer',
        'maximum_user' => 'integer',
        'per_user_amount' => 'integer',
        'markup' => 'integer',
        'discount' => 'integer',
        'valid_from' => 'datetime',
        'valid_to' => 'datetime',
        'is_active' => 'boolean',
        'updated_by' => 'integer',
        'added_by' => 'integer',
    ];

    protected static $logAttributes = ['id', 'name', 'decription', 'code', 'validity_in_days', 'minimum_user', 'maximum_user', 'per_user_amount', 'markup', 'discount', 'valid_from', 'valid_to', 'is_active', 'created_at', 'updated_at', 'updated_by', 'added_by'];
}
