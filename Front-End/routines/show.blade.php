@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $routine->title }}</h1>

    <h3>Exercises</h3>
    @foreach($routine->exercises as $exercise)
        <div class="card mb-4">
            <div class="card-body">
                <h5>{{ $exercise->name }}</h5>
                <p>Sets: {{ $exercise->sets }} | Reps: {{ $exercise->reps }}</p>
            </div>
        </div>
    @endforeach

    <a href="{{ route('routines.index') }}" class="btn btn-secondary">Back to Routines</a>
</div>
@endsection