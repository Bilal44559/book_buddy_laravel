<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReadingGoal extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'year', 'goal', 'books_read'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
