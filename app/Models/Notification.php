<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    // Fillable fields
    protected $fillable = [
        'user_id',
        'type',
        'payload_json',
        'is_read',
    ];

    // Casts
    protected $casts = [
        'payload_json' => 'array',
        'is_read' => 'boolean',
    ];

    // user penerima notifikasi
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
