<x-app>
    <div class="bg-white pt-10 max-w-2xl mx-auto px-5">

        <h2 class="text-5xl text-center">Book lists</h2>
        <form action="{{ route('books.index') }}" method="GET">
            <div class="mt-5 ">
                <input type="text" name="title" placeholder="Search books"
                    class="border border-gray-300 rounded px-4 py-2 w-full" value="{{ request('title') }}">
            </div>
        </form>
        @forelse ($books as $book)
            <div class="bg-gray-100 mt-4 px-4 shadow ">

                <h2 class="text-2xl text-gray-600"><a href="{{ route('books.show', $book) }}">{{ $book->title }}</a>
                </h2>
                <div class="flex justify-between py-2">
                    <div>

                        <cite>{{ $book->author }}</cite>
                        <small class="ml-3">{{ $book->created_at }}</small>
                    </div>
                    <div>

                        <a href="#" class="underline">{{ number_format($book->review_avg_rating, 1) }}
                            Ratted</a>

                    </div>
                </div>
            </div>
        @empty
            <div class="py-10">
                <p class="text-center">No books found</p>
                <div class="text-center">

                    <a href="{{ route('books.index') }}" class="underline text-gray-600 font-bold">reload the page</a>
                </div>

            </div>
        @endforelse
    </div>
</x-app>
