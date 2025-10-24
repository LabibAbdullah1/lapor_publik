<?php

namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    public static function bootLogsActivity()
    {
        static::created(function ($model) {
            self::createLog('created', $model);
        });

        static::updated(function ($model) {
            self::createLog('updated', $model);
        });

        static::deleted(function ($model) {
            self::createLog('deleted', $model);
        });
    }

    protected static function createLog($action, $model)
    {
        AuditLog::create([
            'actor_user_id' => Auth::id(),
            'action' => $action,
            'resource_type' => class_basename($model),
            'resource_id' => $model->id ?? null,
            'metadata_json' => json_encode([
                'attributes' => $model->getAttributes(),
                'changes' => $model->getChanges(),
            ]),
        ]);
    }
}
