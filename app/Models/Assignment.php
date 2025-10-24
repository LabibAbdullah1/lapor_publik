<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{

    protected $fillable = [
        'report_id',
        'assigned_to_user_id',
        'assigned_by_user_id',
        'assigned_at',
        'due_date'
    ];

    public $timestamps = false;

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function assignedTo()
    {
        return $this->belongsTo(User::class, 'assigned_to_user_id');
    }

    public function assignedBy()
    {
        return $this->belongsTo(User::class, 'assigned_by_user_id');
    }
}
