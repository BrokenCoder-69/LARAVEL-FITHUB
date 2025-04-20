@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Create New Workout Routine</h1>

    <form action="{{ route('routines.store') }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="title" class="form-label">Routine Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <h3 class="mb-3">Exercises</h3>

        <div class="exercises-container mb-4">
            <div class="exercise border rounded p-3 mb-3 bg-light">
                <div class="mb-3">
                    <label class="form-label">Exercise Name</label>
                    <input type="text" name="exercises[0][name]" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Sets</label>
                    <input type="number" name="exercises[0][sets]" class="form-control" min="1" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Reps</label>
                    <input type="number" name="exercises[0][reps]" class="form-control" min="1" required>
                </div>
            </div>
        </div>

        <div class="mb-4">
            <button type="button" id="addExercise" class="btn btn-outline-secondary">Add Another Exercise</button>
        </div>

        <button type="submit" class="btn btn-success">Create Routine</button>
    </form>
</div>

<script>
    let exerciseCount = 1;

    document.getElementById('addExercise').addEventListener('click', () => {
        const container = document.querySelector('.exercises-container');
        const newExercise = document.createElement('div');
        newExercise.classList.add('exercise', 'border', 'rounded', 'p-3', 'mb-3', 'bg-light');
        newExercise.innerHTML = `
            <div class="mb-3">
                <label class="form-label">Exercise Name</label>
                <input type="text" name="exercises[${exerciseCount}][name]" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Sets</label>
                <input type="number" name="exercises[${exerciseCount}][sets]" class="form-control" min="1" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Reps</label>
                <input type="number" name="exercises[${exerciseCount}][reps]" class="form-control" min="1" required>
            </div>
        `;
        container.appendChild(newExercise);
        exerciseCount++;
    });
</script>
@endsection