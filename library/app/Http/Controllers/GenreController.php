<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Genre;

class GenreController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genres = Genre::latest()->paginate(10); 
        return view('genres.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('genres.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $r)
    {
        $data = $r->validate(['name'=>'required|string|max:255','description'=>'nullable|string']);
        Genre::create($data);
        return redirect()->route('genres.index')->with('ok','Genre created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        $books = $genre->books()->latest()->paginate(8);
        return view('genres.show', compact('genre','books'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        return view('genres.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r, Genre $genre)
    {
        $data = $r->validate(['name'=>'required|string|max:255','description'=>'nullable|string']);
        $genre->update($data);
        return redirect()->route('genres.index')->with('ok','Genre updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();
        return back()->with('ok','Genre deleted');
    }
}
