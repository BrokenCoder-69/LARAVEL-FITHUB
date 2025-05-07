<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;  // Make sure you import the Complaint model

class ComplaintController extends Controller
{
    // Get all complaints
    public function index()
    {
        $complaints = Complaint::all();
        return response()->json($complaints);
    }

    // Store a new complaint
    public function store(Request $request)
    {
        $request->validate([
            'complaint' => 'required|string|max:500',
        ]);

        $complaint = Complaint::create([
            'complaint' => $request->complaint,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Complaint submitted successfully!',
            'complaint' => $complaint,
        ], 201);
    }
}
