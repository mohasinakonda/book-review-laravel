<x-app>
    <form action="{{ route('books.update', $book) }}" method="POST" class="max-w-2xl p-5 mx-auto bg-white">
        @csrf
        @method('PUT')
        <h2 class="text-3xl text-center">Update book</h2>
        <div class="max-w-xl p-5 mx-auto mt-5 border">
            <p class="pb-1">Book title</p>
            <input type="text" name="title" value="{{ $book->title }}"
                class="w-full px-2 border border-gray-400 rounded h-9 focus:ring-0 focus:outline-none">
            <p class="pb-1">Author</p>
            <input type="text" name="author" value="{{ $book->author }}"
                class="w-full px-2 border border-gray-400 rounded h-9 focus:ring-0 focus:outline-none">
            <button class="w-20 mt-5 border border-gray-400 rounded h-9" type="submit">Update</button>
        </div>
    </form>
</x-app>
