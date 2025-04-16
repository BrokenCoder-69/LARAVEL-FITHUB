<?php

namespace App\Http\Controllers;

use App\Models\Seminar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SeminarController extends Controller
{
    public function book(Request $request){
        $user_id = Auth::id();
        $appointment = Seminar::create([
            'user_id' => $user_id, // client
            'trainer_id' => $request->trainer_id,
            'title' => $request->title,
            'description' => $request->description,
            'phone_number' =>  $request->phone_number,
            'date_time' => $request->date_time,
            'format' => $request->format,
            'description' => $request->description,
            'location' => $request->date_time,
        ]);
    
        return response()->json($appointment);
    }
}
