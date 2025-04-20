<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    // Allow these fields to be mass-assigned
    protected $fillable = ['name', 'specialty', 'bio'];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}