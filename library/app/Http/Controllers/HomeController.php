<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $genres = Genre::latest()->take(6)->get();
        $books  = Book::with('genre')->latest()->take(8)->get();
        return view('home', compact('genres','books'));
    }
}
