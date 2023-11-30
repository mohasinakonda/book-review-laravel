<x-app>
    <form action="{{ route('books.review.store', $book) }}" method="POST" class="max-w-2xl mx-auto bg-white">
        @csrf
        <div class="p-6">
            <h2 class="pt-10 text-3xl text-center">Add Review</h2>
            <p class="py-2 font-medium">
                Reviewer
            </p>
            <input class="block w-full p-4 border border-gray-400 rounded h-9 focus:rign-0 focus:outline-none"
                name="reviewer" />
            <p class="py-2 text-xs font-bold text-gray-700">Rating</p>
            <select name="rating" class="w-full border border-gray-400 rounded h-9">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            <p class="py-2 font-medium">Review</p>
            <textarea name="review" id="body"
                class="w-full p-2 border border-gray-400 rounded focus:rign-0 focus:outline-none" cols="30" rows="5"></textarea>

            @error('body')
                <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <button type="submit" class="px-4 py-2 text-white bg-blue-400 rounded hover:bg-blue-500">
                Add review
            </button>
        </div>
    </form>
</x-app>
