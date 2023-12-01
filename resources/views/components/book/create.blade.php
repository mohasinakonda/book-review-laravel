<x-app>
    <form action="route('book.reviews.create')" method="POST">
        @csrf
        <div class="mb-6">
            <label for="body" class="block mb-2 text-xs font-bold text-gray-700 uppercase">
                Body
            </label>

            <textarea name="body" id="body" class="w-full p-2 border border-gray-400" cols="30" rows="10"></textarea>

            @error('body')
                <p class="mt-2 text-xs text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="mb-6">
            <button type="submit" class="px-4 py-2 text-white bg-blue-400 rounded hover:bg-blue-500">
                Submit
            </button>
        </div>
    </form>
</x-app>
