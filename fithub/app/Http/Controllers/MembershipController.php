<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index()
    {
        $memberships = Membership::all();
        return response()->json($memberships);
    }

    public function subscribe(Request $request)
{
    $user = auth()->user();
    $membership = Membership::find($request->membership_id);

    if (!$membership) {
        return response()->json(['message' => 'Membership not found'], 404);
    }

    // Update membership in user's profile
    $profile = $user->profile;

    if (!$profile) {
        return response()->json(['message' => 'User profile not found'], 404);
    }

    // Calculate start and end date
    $start_date = now();
    $end_date = now()->addDays(30);

    $profile->membership_id = $membership->id;
    $profile->membership_start_date = $start_date;
    $profile->membership_end_date = $end_date;
    $profile->save();

    return response()->json(['message' => 'Subscribed to ' . $membership->name . ' successfully']);
}







    public function myMembership()
{
    $user = auth()->user();
    $profile = $user->profile;

    if (!$profile || !$profile->membership) {
        return response()->json([
            'membership' => null,
            'message' => 'No membership selected'
        ]);
    }

    return response()->json([
        'membership' => [
            'name' => $profile->membership->name,
            'price' => $profile->membership->price,
            'features' => $profile->membership->features,
        ]
    ]);
}

    public function cancelMembership()
{
    $user = auth()->user();
    $profile = $user->profile;

    if (!$profile || !$profile->membership_id) {
        return response()->json(['message' => 'No active membership to cancel.'], 404);
    }

    $profile->membership_id = null;
    $profile->save();

    return response()->json(['message' => 'Membership cancelled successfully.']);
}

    public function getUserSubscription(Request $request)
{
    $user = $request->user();

    $profile = $user->profile; // assuming user hasOne profile
    if (!$profile || !$profile->membership_id) {
        return response()->json([], 404);
    }

    return response()->json([
        'membership' => $profile->membership,
        'membership_start_date' => $profile->membership_start_date,
        'membership_end_date' => $profile->membership_end_date,
    ]);
}   

    public function activateMembership(Request $request)
{
    $user = $request->user(); // Authenticated user
    $profile = $user->profile; // Make sure you have a `profile` relation in User model

    if (!$profile) {
        return response()->json(['error' => 'Profile not found'], 404);
    }

    // Set start date to now and end date 30 days later
    $profile->membership_start_date = now();
    $profile->membership_end_date = now()->addDays(30);
    $profile->save();

    return response()->json([
        'message' => 'Membership activated',
        'membership_start_date' => $profile->membership_start_date,
        'membership_end_date' => $profile->membership_end_date,
    ]);
}




}

