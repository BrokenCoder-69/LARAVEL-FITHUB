{{-- resources/views/trainers/index.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <h1 class="text-3xl font-bold mb-6 text-black">Our Trainers</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($trainers as $trainer)
            <div class="bg-white rounded-lg shadow-md p-6 dark:bg-gray-800">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $trainer->name }}</h2>
                <p class="text-gray-600 dark:text-gray-300 mb-4">
                    {{ $trainer->specialty ?? 'No specialty listed' }}
                </p>
                <a href="{{ route('trainers.show', $trainer) }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    View Profile
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection