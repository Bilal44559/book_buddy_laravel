<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Book,User,UserFollow};

class SocialFeedController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('id', 'desc')->get();
        $users = User::where('id', '!=', auth()->user()->id)->where('is_author', '1')->orderBy('id', 'desc')->get();
        return view('user.social_feed.index')->with(compact('books','users'));
    }

    public function author_profile($id)
    {
        $user = User::findOrFail($id);
        $other_users = User::where('id', '!=', $id)->where('is_author', '1')->orderBy('id', 'desc')->get();

        return view('user.social_feed.author_profile')->with(compact('user','other_users'));
    }

    public function author_liked_books($id)
    {
        $user = User::findOrFail($id);
        $liked_books = $user->liked_books;
        return view('user.social_feed.author_liked_books')->with(compact('user','liked_books'));
    }

    public function store_following_user($id)
    {
        $user = User::findOrFail($id);
        $user_follow = UserFollow::where('follower_user_id', auth()->user()->id)->where('following_user_id', $id)->first();
        if($user_follow){
            $user_follow->delete();
            return back()->with('error', 'User unfollowed successfully');
        }

        $user_follow = new UserFollow();
        $user_follow->follower_user_id = auth()->user()->id;
        $user_follow->following_user_id = $id;
        $user_follow->save();

        return back()->with('success', 'User followed successfully');
    }

    public function show_following($id)
    {
        $user = User::findOrFail($id);
        $followers = UserFollow::with('followers')->where('following_user_id', $id)->get();

        return view('user.social_feed.following_users')->with(compact('user','followers'));
    }
}
