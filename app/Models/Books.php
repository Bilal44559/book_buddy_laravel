<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Books extends Model
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
}
