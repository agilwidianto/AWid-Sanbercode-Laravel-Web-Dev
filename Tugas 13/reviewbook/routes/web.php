<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', fn() => view('home'));

Route::get('/register', fn() => view('register'));

Route::post('/welcome', function (Request $request) {
    $first = $request->input('first_name');
    $last  = $request->input('last_name');
    return view('welcome', ['first_name' => $first, 'last_name' => $last]);
});
