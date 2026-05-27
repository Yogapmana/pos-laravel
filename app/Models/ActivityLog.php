<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * ActivityLog Model - User activity tracking
 *
 * @property int $id
 * @property int $user_id
 * @property string $action
 * @property string|null $model_type
 * @property int|null $model_id
 * @property string $description
 * @property array|null $properties
 * @property string|null $ip_address
 * @property string|null $user_agent
 * @property \Carbon\Carbon $created_at
 */
class ActivityLog extends Model
{
    /** @var bool */
    public $timestamps = false;

    /** @var array<string> */
    protected $fillable = [
        'user_id',
        'action',
        'model_type',
        'model_id',
        'description',
        'properties',
        'ip_address',
        'user_agent',
    ];

    /** @var array<string, string> */
    protected $casts = [
        'properties' => 'array',
        'created_at' => 'datetime',
    ];

    /**
     * Get the user that owns the activity log
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}