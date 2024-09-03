<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Books;
use App\Models\Rating;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Books::get();
        return view('user.books.index', compact('books'));
    }
    public function show($id)
    {
        $book = Books::findOrFail($id);
        $ratings = Rating::where('book_id', $id)->OrderBy('id', 'desc')->get();
        $recommended_books = Books::where('id', '!=', $id)->where('is_active', '1')->limit(5)->get();
        return view('user.books.detail', compact('book', 'ratings', 'recommended_books'));
    }

    public function rating_store(Request $request, $id)
    {
        $rating = Rating::where('user_id', auth()->user()->id)->where('book_id', $id)->first();
        if ($rating) {
            $rating->rating = $request->rate;
            $rating->comment = $request->comment;
            $rating->save();
        } else {
            $rating = new Rating();
            $rating->user_id = auth()->user()->id;
            $rating->book_id = $id;
            $rating->rating = $request->rate;
            $rating->comment = $request->comment;
            $rating->save();
        }
        return back()->with('success', 'Rating added successfully');
    }
}
