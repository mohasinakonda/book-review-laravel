<x-app>
    <div class="max-w-2xl p-5 mx-auto bg-white">
        <a href="{{ route('books.index') }}" class="font-bold text-gray-600 underline">Back to books</a>
        <h2 class="text-5xl">{{ $book->title }}</h2>
        <cite>{{ $book->author }}</cite>
        <div class="flex gap-2 py-2">
            <div class="flex gap-2">

                <x-star-rating :rating="$book->review_avg_rating" />
                <p>{{ $book->review_count }} {{ Str::plural('review') }}</p>
            </div>

            <a href="{{ route('books.review.create', $book) }}" class="underline">Add review</a>
        </div>

        <div>
            <p>{{ $book->description }}</p>
        </div>
        <h2 class="pt-10 text-3xl font-medium">Reviews</h2>
        <div class="bg-gray-100">
            @forelse($book->review as $review)
                <div class="p-4 mt-5 bg-white shadow">
                    <h3 class="text-xl font-medium">{{ $review->reviewer }}</h3>
                    <span class="font-bold"><x-star-rating :rating="$review->rating" /></span>
                    <span class="font-medium">{{ $review->created_at }}</span>
                    <p class="pt-4">{{ $review->review }}</p>
                </div>
            @empty <p>No review Available</p>
            @endforelse
        </div>
</x-app>
