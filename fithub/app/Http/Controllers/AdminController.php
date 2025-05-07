<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function user_count(){
        $user = User::where('role', 'user')->orderBy('created_at', 'desc')->count();
        return response()->json($user, 200);
    }
    public function trainer_count(){
        $trainer = User::where('role', 'trainer')->orderBy('created_at', 'desc')->count();
        return response()->json($trainer, 200);
    }
}
