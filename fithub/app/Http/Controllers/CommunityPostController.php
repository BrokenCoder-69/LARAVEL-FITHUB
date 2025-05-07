<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityPost;  // Ensure you have this model

class CommunityPostController extends Controller
{
    /**
     * Store a newly created community post.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'user_id' => 'required|integer',  // Ensure you pass a valid user_id
        ]);

        // Create a new post using the validated data
        $post = CommunityPost::create([
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'user_id' => $validatedData['user_id'],
        ]);

        // Return a response indicating the post was created
        return response()->json([
            'message' => 'Post created successfully!',
            'post' => $post
        ], 201);  // 201 status code means resource created successfully
    }
}
