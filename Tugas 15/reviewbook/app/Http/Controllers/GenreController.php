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
        return view('genre.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('genre.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:genres,name',
            'description' => 'nullable|string',
        ]);
        Genre::create($data);
        return redirect()->route('genre.index')->with('success','Genre berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Genre $genre)
    {
        return view('genre.show', compact('genre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Genre $genre)
    {
        return view('genre.edit', compact('genre'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Genre $genre)
    {
        $data = $request->validate([
            'name' => 'required|string|max:100|unique:genres,name,'.$genre->id,
            'description' => 'nullable|string',
        ]);
        $genre->update($data);
        return redirect()->route('genre.index')->with('success','Genre berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Genre $genre)
    {
        $genre->delete();
        return redirect()->route('genre.index')->with('success','Genre berhasil dihapus.');
    }
}
