<?php

namespace App\Models;

use App\Traits\HasRecordOwnerProperties;
use Illuminate\Database\Eloquent\Model as Model;
use Spatie\Activitylog\Traits\LogsActivity;

class Customer extends Model
{
    use HasRecordOwnerProperties;
    use LogsActivity;

    /**
     * @var string
     */
    protected $table = 'customers';

    /**
     * @var string[]
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'profile',
        'contact_number',
        'email',
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
        'first_name' => 'string',
        'last_name' => 'string',
        'profile' => 'string',
        'contact_number' => 'string',
        'email' => 'string',
        'is_active' => 'boolean',
        'updated_by' => 'integer',
        'added_by' => 'integer',
    ];

    protected static $logAttributes = ['id', 'first_name', 'last_name', 'profile', 'contact_number', 'email', 'is_active', 'created_at', 'updated_at', 'updated_by', 'added_by'];
}
