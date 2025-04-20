<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkoutRoutine extends Model
{
    protected $fillable = ['title', 'user_id'];

    public function exercises()
    {
        return $this->hasMany(Exercise::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}