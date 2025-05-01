<?php

namespace App\Http\Controllers;

use App\Models\Appoinment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppoinmentController extends Controller
{
    public function book(Request $request){
        $user_id = Auth::id();
        $appointment = Appoinment::create([
            'user_id' => $user_id, // client
            'trainer_id' => $request->trainer_id,
            'time' => $request->appointment_time,
        ]);
    
        return response()->json($appointment, 201);
    }


    public function trainer(Request $request){
        $trainers = User::where('role', 'trainer')->select('id', 'name')->get();

        return response()->json($trainers);
    }
}
