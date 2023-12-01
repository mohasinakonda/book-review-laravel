<x-app>
    <div class="max-w-2xl px-5 pt-10 mx-auto bg-white">

        <h2 class="text-5xl text-center">Book lists</h2>
        <form action="{{ route('books.index') }}" method="GET" class="flex gap-5 mt-5">
            <div class="w-[500px]">
                <input type="hidden" name="filter" value="{{ request('filter') }}">
                <input type="text" name="title" placeholder="Search books"
                    class="w-full px-4 py-2 border border-gray-300 rounded " value="{{ request('title') }}">
            </div>
            <a href="{{ route('books.create') }}" class="block w-32 h-10 p-1 px-5 border border-gray-400 rounded">Add a
                book</a>
        </form>

        @php
            $filter = [
                '' => 'Latest',
                'popular_in_last_month' => 'Popular in last month',
                'popular_in_last_6months' => 'Popular in last 6 months',
                'highest_rated_last_month' => 'Highest rated last month',
                'highest_rated_last_6month' => 'Highest rated last 6 months',
            ];
        @endphp

        <div class="p-5 my-5 bg-gray-100">
            @foreach ($filter as $key => $value)
                <a href="{{ route('books.index', ['title' => request('title'), 'filter' => $key]) }}"
                    class="inline-block px-4 py-2  {{ request('filter') == $key ? 'bg-gray-300 shadow' : '' }}">{{ $value }}</a>
            @endforeach
        </div>
        @forelse ($books as $book)
            <div class="px-4 mt-4 bg-gray-100 shadow ">
                <div class="flex justify-between">

                    <h2 class="text-2xl text-gray-600"><a
                            href="{{ route('books.show', $book) }}">{{ $book->title }}</a>
                    </h2>
                    <a class="underline" href="{{ route('books.edit', $book) }}">Edit</a>
                </div>

                <div class="flex justify-between py-2">
                    <div>

                        <cite>{{ $book->author }}</cite>
                        <small class="ml-3">{{ $book->created_at }}</small>
                    </div>
                    <div class="flex gap-2">

                        <x-star-rating :rating="$book->review_avg_rating" />
                        <p>{{ $book->review_count }} {{ Str::plural('review') }}</p>

                    </div>
                </div>
            </div>
        @empty
            <div class="py-10">
                <p class="text-center">No books found</p>
                <div class="text-center">

                    <a href="{{ route('books.index') }}" class="font-bold text-gray-600 underline">reload the page</a>
                </div>

            </div>
        @endforelse
    </div>
</x-app>
