<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommunityPost;

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
            'user_id' => 'required|integer|exists:users,id',  // Ensure user_id exists in users table
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

    /**
     * Fetch all community posts.
     */
    public function index()
    {
        $posts = CommunityPost::all();  // Get all posts from the database
        return response()->json([
            'posts' => $posts
        ]);
    }
}
