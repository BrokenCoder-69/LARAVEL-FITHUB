<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    public function premium()
    {
        return response()->json(Trainer::where('is_premium', true)->get());
    }
}

