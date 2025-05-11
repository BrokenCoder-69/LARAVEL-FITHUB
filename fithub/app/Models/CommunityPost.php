<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityPost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'user_id',
    ];

    // If you have any relationships like 'user' model, you can define them here.
    public function user()
    {
        return $this->belongsTo(User::class);  // Assuming you have a User model and relationship
    }
}
