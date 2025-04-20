{{-- resources/views/trainers/show.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-black">
    <h1 class="text-3xl font-bold mb-2">{{ $trainer->name }}</h1>
    <p class="mb-2"><strong>Specialty:</strong> {{ $trainer->specialty ?? 'No specialty listed' }}</p>
    <p class="mb-6"><strong>Bio:</strong> {{ $trainer->bio ?? 'No bio available' }}</p>

    <h2 class="text-2xl font-semibold mb-4">Reviews</h2>

    <div class="space-y-4 mb-8">
        @forelse($trainer->reviews as $review)
            <div class="bg-gray-100 p-4 rounded shadow">
                <p><strong>{{ $review->user->name }}</strong> (Rating: {{ $review->rating }}/5)</p>
                <p>{{ $review->comment }}</p>
            </div>
        @empty
            <p class="text-gray-600">No reviews yet.</p>
        @endforelse
    </div>

    {{-- Add Review Form --}}
    @auth
        <h3 class="text-xl font-semibold mb-2">Leave a Review</h3>
        <form action="{{ route('reviews.store', $trainer) }}" method="POST" class="bg-gray-100 p-6 rounded shadow space-y-4">
            @csrf
            <div>
                <label for="rating" class="block text-sm font-medium text-gray-700">Rating (1-5)</label>
                <input type="number" name="rating" id="rating" min="1" max="5" required
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-300 bg-white text-black">
            </div>
            <div>
                <label for="comment" class="block text-sm font-medium text-gray-700">Comment</label>
                <textarea name="comment" id="comment" rows="3"
                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring focus:ring-blue-300 bg-white text-black"></textarea>
            </div>
            <button type="submit"
                    class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                Submit Review
            </button>
        </form>
    @else
        <p class="text-gray-600">You must be logged in to leave a review.</p>
    @endauth
</div>
@endsection