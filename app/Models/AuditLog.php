<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    // Fillable fields
    protected $fillable = [
        'actor_user_id',
        'action',
        'resource_type',
        'resource_id',
        'metadata_json',
    ];

    // Casts
    protected $casts = [
        'metadata_json' => 'array',
    ];

    // user yang melakukan aksi
    public function actorUser()
    {
        return $this->belongsTo(User::class, 'actor_user_id');
    }
}
