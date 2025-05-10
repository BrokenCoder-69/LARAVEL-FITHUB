<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function selectTrainer(Request $request)
{
    $request->validate(['trainer_id' => 'required|exists:trainers,id']);

    $user = $request->user();

    if ($user->profile->trainer_id) {
        return response()->json(['message' => 'You have already selected a trainer. Please cancel your current trainer to select a new one.'], 403);
    }

    $user->profile->trainer_id = $request->trainer_id;
    $user->profile->save();

    return response()->json(['message' => 'Trainer selected successfully.']);
}


    public function getUserTrainer(Request $request)
    {
        $trainer = $request->user()->profile->trainer;
        return response()->json($trainer);
    }

    public function cancelTrainer(Request $request)
{
    $user = $request->user();

    if (!$user->profile || !$user->profile->trainer_id) {
        return response()->json(['message' => 'No trainer to cancel.'], 400);
    }

    $user->profile->trainer_id = null;
    $user->profile->save();

    return response()->json(['message' => 'Trainer cancelled successfully.']);
}

}

