<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

use function Laravel\Prompts\note;

class StatusHistory extends Model
{
    use HasFactory;

    protected $table = 'status_history';
    public $timestamps = false;

    protected $fillable = [
        'report_id',
        'from_status',
        'to_status',
        'changed_by_user_id',
        'note',
    ];

    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function changedBy()
    {
        return $this->belongsTo(User::class, 'changed_by_user_id');
    }
}
