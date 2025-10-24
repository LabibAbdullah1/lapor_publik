<?php

namespace App\Models;

use App\Traits\LogsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


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

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($photo) {
            if(Storage::disk('public')->exists($photo->file_path)) {
                Storage::disk('public')->delete($photo->file_path);
            }
        });
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
