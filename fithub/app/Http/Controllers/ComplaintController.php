<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    // Store a new complaint
    public function store(Request $request)
    {
        // Validate the incoming complaint data
        $request->validate([
            'complaint' => 'required|string|max:255', // Ensure complaint field is provided
            'user_id' => 'required|integer|exists:users,id', // Ensure user_id exists in the users table
        ]);

        // Create a new complaint record
        $complaint = new Complaint();
        $complaint->user_id = $request->user_id;  // Get user_id from the frontend
        $complaint->complaint = $request->complaint; // Get complaint content from frontend
        $complaint->status = 'pending';  // Default status is 'pending'
        $complaint->save();  // Save the complaint to the database

        return response()->json(['message' => 'Complaint created successfully']);
    }

    // Admin views all complaints
    public function index()
    {
        $complaints = Complaint::all();
        return response()->json($complaints);
    }

    // User views their own complaints
    public function userComplaints()
    {
        $complaints = Complaint::where('user_id', auth()->id())->get();
        return response()->json($complaints);
    }

    // Admin resolves a complaint
    public function resolve($id)
    {
        $complaint = Complaint::findOrFail($id);  // Find the complaint by ID
        $complaint->status = 'resolved';  // Set status to 'resolved'
        $complaint->save();  // Save the updated status

        return response()->json(['message' => 'Complaint resolved successfully']);
    }
}

