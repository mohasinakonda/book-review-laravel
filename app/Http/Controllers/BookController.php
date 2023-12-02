<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $filter = $request->input('filter');
        $title = $request->input('title');
        $books = Book::when($title, function ($query, $title) {
            return $query->title($title);
        })->withAvg('review', 'rating');
        $books = match ($filter) {
            'popular_in_last_month' => $books->popularLastMonth(),
            'popular_in_last_6months' => $books->popularLast6Months(),
            'highest_rated_last_month' => $books->highestRatedLastMonth(),
            'highest_rated_last_6months' => $books->highestRatedLast6Months(),
            default => $books->withReviewsCount()->latest()
        };

        $books = $books->paginate(10);
        // return $books;

        return view('books', ['books' => $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $books = new Book();
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required'
        ]);
        $books->create($data);
        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $book = Book::withReviewsCount()->withAvgRating()->findOrFail($id);
        $reviews = $book->review()->latest()->paginate(10);

        return view('book', ['book' => $book, 'reviews' => $reviews]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('books.edit', ['book' => $book]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required'
        ]);
        $book->update($data);
        return redirect()->route('books.show', $book);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index');
    }
}
