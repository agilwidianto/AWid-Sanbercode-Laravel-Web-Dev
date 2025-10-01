<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Genre;

class BookController extends Controller
{
    // public function __construct(){
    //     // public boleh index, show; admin untuk create/update/delete
    //     $this->middleware(['auth','admin'])->except(['index','show']);
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::with('genre')->latest()->paginate(12);
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $genres = \App\Models\Genre::orderBy('name')->get();
        return view('books.create', compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $r)
    {
        $data = $r->validate([
            'title'     => 'required|string|max:255',
            'summary'   => 'nullable|string',
            'stock'     => 'required|integer|min:0',
            'genre_id'  => 'required|exists:genres,id',
            'cover'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $path = null;
        if ($r->hasFile('cover')) {
            $path = $r->file('cover')->store('covers', 'public');
        }

        Book::create([
            'title' => $data['title'],
            'summary' => $data['summary'] ?? null,
            'stock' => $data['stock'],
            'genre_id' => $data['genre_id'],
            'user_id' => auth()->id(),
            'cover_path' => $path,
        ]);

        return redirect()->route('books.index')->with('ok','Book created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        $book->load(['genre','comments.user']);
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        $genres = Genre::orderBy('name')->get();
        return view('books.edit', compact('book','genres'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r, Book $book)
    {
        $data = $r->validate([
            'title'     => 'required|string|max:255',
            'summary'   => 'nullable|string',
            'stock'     => 'required|integer|min:0',
            'genre_id'  => 'required|exists:genres,id',
            'cover'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($r->hasFile('cover')) {
            if ($book->cover_path && Storage::disk('public')->exists($book->cover_path)) {
                Storage::disk('public')->delete($book->cover_path);
            }
            $book->cover_path = $r->file('cover')->store('covers','public');
        }

        $book->update([
            'title'=>$data['title'],
            'summary'=>$data['summary'] ?? null,
            'stock'=>$data['stock'],
            'genre_id'=>$data['genre_id'],
            'cover_path'=>$book->cover_path,
        ]);

        return redirect()->route('books.index')->with('ok','Book updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if ($book->cover_path) Storage::disk('public')->delete($book->cover_path);
        $book->delete();
        return redirect()->route('books.index')->with('ok','Book deleted');
    }
}
