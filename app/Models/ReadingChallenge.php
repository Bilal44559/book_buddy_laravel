<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadingChallenge extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'icon', 'description', 'time_frame'];

    // Many-to-Many relationship with Book
    public function books()
    {
        return $this->belongsToMany(Book::class, 'challenge_book', 'reading_challenge_id', 'book_id');
    }
}
