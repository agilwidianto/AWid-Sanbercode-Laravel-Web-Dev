<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\UserManagementController;

Route::get('/', fn () => redirect()->route('login'))->name('home');
Route::get('/dashboard', fn () => view('dashboard'))->middleware('auth')->name('dashboard');

// Route::get('/', function () {
//     return redirect()->route('login');
// });

/* ---------- ADMIN (login + role admin) ---------- */
Route::middleware(['auth','admin'])->group(function () {
    Route::resource('genres', GenreController::class)->except(['index','show']);
    Route::resource('books',  BookController::class)->except(['index','show']);
    Route::resource('admin/users', UserManagementController::class)->except(['create', 'store', 'show']);
});

/* ---------- PUBLIC (tanpa login) ---------- */
Route::get('/', [BookController::class, 'index'])->name('catalog');
Route::resource('genres', GenreController::class)->only(['index','show'])->whereNumber('genre');
Route::resource('books',  BookController::class)->only(['index','show'])->whereNumber('book');

/* ---------- AUTH (user login) ---------- */
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class,'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class,'upsert'])->name('profile.upsert');

    Route::get('/genres/{genre}/edit', [GenreController::class,'edit'])->name('genres.edit');
    Route::put('/genres/{genre}',        [GenreController::class,'update'])->name('genres.update');
    Route::delete('/genres/{genre}',     [GenreController::class,'destroy'])->name('genres.destroy');

    Route::post('/books/{book}/comments', [CommentController::class,'store'])->name('comments.store');
    Route::delete('/books/{book}/comments/{comment}', [CommentController::class,'destroy'])->name('comments.destroy');

    // Route::get('/dashboard', fn () => view('dashboard'))->middleware('verified')->name('dashboard');
});

require __DIR__.'/auth.php';
