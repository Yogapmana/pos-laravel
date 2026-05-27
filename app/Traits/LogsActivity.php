<?php

namespace App\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Request;

trait LogsActivity
{
    /**
     * Boot the trait - register events
     */
    public static function bootLogsActivity(): void
    {
        // Created event
        static::created(function ($model) {
            static::logActivity('created', $model, "membuat {$model->getTable()}");
        });

        // Updated event
        static::updated(function ($model) {
            $changes = $model->getChanges();
            unset($changes['updated_at']);
            if (!empty($changes)) {
                static::logActivity('updated', $model, "memperbarui {$model->getTable()}");
            }
        });

        // Deleted event
        static::deleted(function ($model) {
            static::logActivity('deleted', $model, "menghapus {$model->getTable()}");
        });
    }

    /**
     * Log activity
     */
    protected static function logActivity(string $action, $model, string $description): void
    {
        if (!auth()->check()) {
            return;
        }

        ActivityLog::create([
            'user_id' => auth()->id(),
            'action' => $action,
            'model_type' => get_class($model),
            'model_id' => $model->getKey(),
            'description' => $description . ' - ' . ($model->name ?? $model->id ?? ''),
            'properties' => $action === 'updated' ? $model->getChanges() : null,
            'ip_address' => Request::ip(),
            'user_agent' => Request::userAgent(),
        ]);
    }
}