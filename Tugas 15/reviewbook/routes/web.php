<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Genre;
use App\Http\Controllers\GenreController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/welcome', function () {
    $latestGenres = Genre::latest()->take(5)->get();
    $first = session('first_name');
    $last  = session('last_name');

    return view('welcome', [
        'latestGenres' => $latestGenres,
        'first_name'   => $first,
        'last_name'    => $last,
    ]);
})->name('welcome');

Route::get('/register', fn() => view('register'));

Route::post('/welcome', function (Request $request) {
    $first = $request->input('first_name');
    $last  = $request->input('last_name');
    $latestGenres = Genre::latest()->take(5)->get();

    return view('welcome', [
        'first_name'   => $first,
        'last_name'    => $last,
        'latestGenres' => $latestGenres,
    ]);
})->name('welcome.submit');

Route::resource('genre', GenreController::class);
