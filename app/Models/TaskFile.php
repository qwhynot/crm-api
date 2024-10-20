<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskFile extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $fillable = [
        'task_id',
        'file_path',
        'file_name',
        'mime_type',
        'file_size',
        'description'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d.m.Y H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d.m.Y H:i:s');
    }
}
