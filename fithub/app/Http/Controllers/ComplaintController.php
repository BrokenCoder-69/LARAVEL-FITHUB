<?php
namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    // Fetch all complaints
    public function index()
    {
        $complaints = Complaint::all();  // Fetch all complaints from the database

        // If no complaints are found, return a 204 No Content status with a message
        if ($complaints->isEmpty()) {
            return response()->json(['message' => 'No complaints found'], 204);
        }

        // Return the complaints in JSON format
        return response()->json($complaints);  // HTTP 200: OK
    }

    // Submit a new complaint
    public function store(Request $request)
    {
        // Validate the incoming request
        $validated = $request->validate([
            'complaint' => 'required|string|max:255',  // The complaint field is required, must be a string, and max 255 characters
        ]);

        // Create a new complaint entry in the database
        $complaint = Complaint::create([
            'complaint' => $validated['complaint'],
            'status' => 'pending',  // Default status is 'pending'
        ]);

        // Return the newly created complaint as a JSON response with HTTP status 201 (Created)
        return response()->json($complaint, 201);  // HTTP 201: Created
    }

    // Resolve a complaint
    public function resolve($id)
    {
        // Find the complaint by its ID. If not found, a 404 error is automatically returned
        $complaint = Complaint::findOrFail($id);

        // Update the complaint's status to 'resolved'
        $complaint->status = 'resolved';
        $complaint->save();  // Save the updated status in the database

        // Return the resolved complaint as a JSON response
        return response()->json($complaint);  // HTTP 200: OK
    }
}
