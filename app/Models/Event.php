<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function comments()
    {

        return $this->hasMany(EventComment::class, 'event_id')->where('parent_id', null);
    }

    public function all_comments()
    {
        return $this->hasMany(EventComment::class, 'event_id');
    }
}
