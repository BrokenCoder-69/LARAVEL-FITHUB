@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Your Workout Routines</h1>

    <div class="mb-4 text-end">
        <a href="{{ route('routines.create') }}" class="btn btn-success">+ Create New Routine</a>
    </div>

    <div class="row g-4">
        @forelse($routines as $routine)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $routine->title }}</h5>
                        <a href="{{ route('routines.show', $routine) }}" class="btn btn-outline-primary btn-sm mt-3">View Routine</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">You have no workout routines yet.</p>
        @endforelse
    </div>
</div>
@endsection

