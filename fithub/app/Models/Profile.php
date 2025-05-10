<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'name', 'phone', 'age', 'height', 'weight', 'goal', 'bmi', 'bmi_category'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trainer()
{
    return $this->belongsTo(Trainer::class);
}

    public function membership()
{
    return $this->belongsTo(Membership::class);
}

}

