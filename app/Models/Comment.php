<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory, LogsActivity;

    // Fillable fields
    protected $fillable = [
        'post_id',
        'user_id',
        'content',
        'created_at',
        'updated_at',
    ];

    // Define the relationship with the Report model
    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
