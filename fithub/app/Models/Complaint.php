<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complaint extends Model
{
    use HasFactory;

    // Define the columns that are mass-assignable
    protected $fillable = ['complaint', 'status'];

    // Optionally, you can define relationships here (if needed in the future)
}
