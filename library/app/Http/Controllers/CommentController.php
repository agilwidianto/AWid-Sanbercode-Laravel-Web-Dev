<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Book;

class CommentController extends Controller
{
    public function __construct(){ $this->middleware('auth'); }
    
    public function store(Request $r, Book $book){
        $data = $r->validate(['content'=>'required|string|max:1000']);
        $book->comments()->create([
            'user_id'=>auth()->id(),
            'content'=>$data['content']
        ]);
        return back()->with('ok','Comment added');
    }

    public function destroy(Book $book, Comment $comment){
        // Hanya pemilik comment atau admin
        if (auth()->id() !== $comment->user_id && !auth()->user()->isAdmin()) {
            abort(403);
        }
        $comment->delete();
        return back()->with('ok','Comment deleted');
    }
}
