<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model {
    use HasFactory;
    protected $fillable = ['genre_id','user_id','title','summary','stock','cover_path'];
    public function genre(){ return $this->belongsTo(Genre::class); }
    public function user(){ return $this->belongsTo(User::class); } // uploader
    public function comments(){ return $this->hasMany(Comment::class); }
}
