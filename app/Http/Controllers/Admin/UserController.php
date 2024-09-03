<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('user_type','user')->OrderBy('id','DESC')->get();
        return view('admin.users.index')->with(compact('users'));
    }
    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'is_author' => 'required|boolean',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => \Hash::make('admin786'),
            'is_author' => $validatedData['is_author'],
        ]);

        return to_route('user.user-creation.index')->with('success', 'User created successfully!');
    }

    public function edit($id)
    {
        $user =  User::findOrFail($id);
        return view('admin.users.edit')->with(compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id . '|max:255',
            'is_author' => 'required|boolean',
        ]);

        $user = User::findOrFail($id);

        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'is_author' => $validatedData['is_author'],
        ]);

        return to_route('user.user-creation.index')->with('success', 'User updated successfully!');
    }

    public function delete(Request $request)
    {
        User::destroy($request->id);
        return back()->with('success', 'User deleted successfully!');
    }
}
