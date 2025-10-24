<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;

class ReportPhoto extends Model
{
    use LogsActivity;
    // Fillable fields
    protected $fillable = [
        'report_id',
        'file_path',
        'uploaded_by',
        'uploaded_at',
    ];

    // Define the relationship with the Report model
    public function report()
    {
        return $this->belongsTo(Report::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
