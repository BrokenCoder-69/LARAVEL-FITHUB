<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Store a new review
    public function store(Request $request, Trainer $trainer)
    {
        // Validate the review data
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',  // Rating must be between 1 and 5
            'comment' => 'nullable|string|max:1000',     // Optional comment with max length of 1000
        ]);

        // Create a new review
        Review::create([
            'user_id' => auth()->id(),  // Get the currently authenticated user
            'trainer_id' => $trainer->id,  // The trainer being reviewed
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        // Redirect back to the trainer page with a success message
        return redirect()->route('trainers.show', $trainer)->with('success', 'Review submitted successfully!');
    }
}