<x-app>
    <div class="max-w-2xl p-5 mx-auto bg-white">
        <h2 class="text-5xl">{{ $book->title }}</h2>
        <cite>{{ $book->author }}</cite>
        <div class="flex justify-between py-2">
            <div>
                <p>{{ number_format($book->review_avg_rating, 1) }} rated</p>
                <p>{{ $book->review_count }} {{ Str::plural('review') }}</p>
            </div>


        </div>
        <h2 class="pt-10 text-3xl font-medium">Reviews</h2>
        <div class="bg-gray-100">
            @forelse($book->review as $review)
                <div class="p-4 mt-5 bg-white shadow">
                    <h3 class="text-xl font-medium">{{ $review->reviewer }}</h3>
                    <span class="font-bold">Rating {{ $review->rating }} out of 5</span>
                    <span class="font-medium">{{ $review->created_at }}</span>
                    <p class="pt-4">{{ $review->review }}</p>
                </div>
            @empty <p>No review Available</p>
            @endforelse
        </div>
</x-app>
