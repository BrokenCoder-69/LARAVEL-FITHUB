<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    protected $fillable = ['workout_routine_id', 'name', 'sets', 'reps'];

    public function routine()
    {
        return $this->belongsTo(WorkoutRoutine::class, 'workout_routine_id');
    }
}
