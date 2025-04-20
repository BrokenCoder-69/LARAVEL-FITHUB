<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkoutRoutine;
use App\Models\Exercise;
use Illuminate\Support\Facades\Auth;

class WorkoutRoutineController extends Controller
{
    public function index()
    {
        $routines = WorkoutRoutine::where('user_id', Auth::id())->with('exercises')->get();
        return view('routines.index', compact('routines'));
    }

    public function create()
    {
        return view('routines.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'exercises.*.name' => 'required|string',
            'exercises.*.sets' => 'required|integer|min:1',
            'exercises.*.reps' => 'required|integer|min:1',
        ]);

        $routine = WorkoutRoutine::create([
            'title' => $request->title,
            'user_id' => Auth::id(),
        ]);

        foreach ($request->exercises as $exercise) {
            $routine->exercises()->create($exercise);
        }

        return redirect()->route('routines.index')->with('success', 'Workout routine created!');
    }

    public function show($id)
    {
        $routine = WorkoutRoutine::with('exercises')->findOrFail($id);
        if ($routine->user_id !== Auth::id()) {
            abort(403); // Prevent viewing others' routines
        }
        return view('routines.show', compact('routine'));
    }
}

