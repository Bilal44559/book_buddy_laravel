<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserFollow extends Model
{
    use HasFactory;

    public function followers()
    {
        return $this->hasOne(User::class, 'id', 'follower_user_id');
    }
}
