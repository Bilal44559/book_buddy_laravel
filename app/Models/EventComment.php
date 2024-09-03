<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventComment extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sub_comments()
    {
        return $this->hasMany(EventComment::class, 'parent_id')->with('sub_comments');
    }
}
