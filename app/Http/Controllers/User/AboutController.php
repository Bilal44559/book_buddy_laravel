<?php

namespace App\Http\Controllers\User;

use App\Models\Group;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        $groups = Group::get();
        return view('user.about.index', compact('groups'));
    }
}
