<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = false;

    protected $fillable = [
      'name',
      'description',
      'status',
      'start_date',
      'end_date',
      'budget',
      'created_by',
      'updated_by',
      'notes',
      'tags',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function getCreatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d.m.Y H:i:s');
    }

    public function getUpdatedAtAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d.m.Y H:i:s');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'project_user');
    }
}
