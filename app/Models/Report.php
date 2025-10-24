<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use LogsActivity;
    
    // Report model code here
    protected $fillable = [
        'reporter_id',
        'title',
        'description',
        'category',
        'priority',
        'status',
        'location_lat',
        'location_lng',
        'address',
        'anonymous'
    ];

    // Define relationships, accessors, mutators, etc.

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reporter_id');
    }

    public function photos()
    {
        return $this->hasMany(ReportPhoto::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function statusHistories()
    {
        return $this->hasMany(StatusHistory::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}
