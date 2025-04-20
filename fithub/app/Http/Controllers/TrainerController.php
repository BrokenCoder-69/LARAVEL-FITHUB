<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    // Show list of all trainers
    public function index()
    {
        $trainers = Trainer::all();
        return view('trainers.index', compact('trainers'));
    }

    // Show a single trainer and their reviews
    public function show(Trainer $trainer)
    {
        $trainer->load('reviews.user'); // Eager load the user who wrote each review
        return view('trainers.show', compact('trainer'));
    }
}