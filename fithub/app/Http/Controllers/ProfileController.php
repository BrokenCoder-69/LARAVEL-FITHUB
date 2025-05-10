<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'age' => 'required|integer|min:0',
            'height' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'goal' => 'required|string|max:255',
        ]);

        // BMI Calculation
        $heightInMeters = $validated['height'] / 100;
        $bmi = $validated['weight'] / ($heightInMeters ** 2);
        $bmi = round($bmi, 2);

        // BMI Category
        if ($bmi < 18.5) {
            $bmiCategory = 'Underweight';
        } elseif ($bmi < 24.9) {
            $bmiCategory = 'Normal weight';
        } elseif ($bmi < 29.9) {
            $bmiCategory = 'Overweight';
        } else {
            $bmiCategory = 'Obese';
        }

        $profileData = array_merge($validated, [
            'bmi' => $bmi,
            'bmi_category' => $bmiCategory,
        ]);

        $profile = $user->profile()->updateOrCreate(
            ['user_id' => $user->id],
            $profileData
        );

        return response()->json([
            'message' => 'Profile updated successfully.',
            'profile' => $profile
        ]);
    }

    

}

