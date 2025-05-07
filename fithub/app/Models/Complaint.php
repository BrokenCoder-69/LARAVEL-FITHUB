<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    // Define fillable attributes to protect against mass-assignment vulnerability
    protected $fillable = [
        'complaint',  // Complaint content/description
        'status',     // Status of the complaint (pending, resolved)
        'user_id',    // The ID of the user who submitted the complaint
    ];

    // Set the table name if it's not 'complaints'
    protected $table = 'complaints';

    // Default status is 'pending' when a complaint is created
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($complaint) {
            if (empty($complaint->status)) {
                $complaint->status = 'pending'; // Default to 'pending'
            }
        });
    }

    // Define the relationship between Complaints and Users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
