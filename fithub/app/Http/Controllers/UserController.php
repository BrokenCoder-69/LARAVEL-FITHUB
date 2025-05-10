<?php

namespace App\Http\Controllers;

use App\Models\Seminar;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    // Display a listing of all regular users
    public function index(Request $request)
    {
        $users = User::where('role','user')->orderBy('created_at', 'desc')->get();
        return response()->json($users, 200);
    }


    //Display the specified user by ID.

    public function show($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        return response()->json($user, 200);
    }


    
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }
        $user->update($request->all());
        return response()->json($user, 200);
    }




    public function destroy($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted successfully'], 200);
    }


    //Get all seminars booked by the currently authenticated user.

    public function seminar(){
        $user_id = Auth::id();
        $appointments = Seminar::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
        return response()->json($appointments, 200);
    }
}
