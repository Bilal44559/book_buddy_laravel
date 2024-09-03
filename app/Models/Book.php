<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    public function rating()
    {
        return $this->hasMany(Rating::class, 'book_id');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function readingChallenges()
    {
        return $this->belongsToMany(ReadingChallenge::class, 'challenge_book', 'book_id', 'reading_challenge_id');
    }

    public function likedBooks()
    {
        return $this->belongsToMany(User::class, 'liked_books', 'book_id', 'user_id');
    }
}
