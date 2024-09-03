<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    public function joined_users()
    {
        return $this->hasMany(JoinedGroup::class, 'group_id', 'id');
    }
    
    public function users()
    {
        return $this->belongsToMany(User::class, 'joined_groups', 'group_id', 'user_id');
    }
}
