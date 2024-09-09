<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Rating;
use App\Models\LikedBook;
use Illuminate\Http\Request;
use App\Models\ReadBook;


class BookController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        $rating = $request->input('rate');
        $publish_date = $request->input('publish_date');
        $query = Book::query();
        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('genre', 'like', '%' . $search . '%')
                    ->orWhereHas('author', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            });
        }
        if (!empty($rating)) {
            $query->join('ratings', 'books.id', '=', 'ratings.book_id')
                ->where('ratings.rating', '=', $rating)
                ->select('books.*'); // Ensure only book columns are selected
        }
        if (!empty($publish_date)) {
            $query->where('publish_date', '=', $publish_date);
        }

        $books = $query->orderBy('id', 'desc')->get();
        return view('user.books.index', compact('books'));
    }

    public function show($id)
    {

        $book = Book::findOrFail($id);
        $ratings = Rating::where('book_id', $id)->OrderBy('id', 'desc')->get();
        $recommended_books = Book::where('id', '!=', $id)->where('is_active', '1')->limit(5)->get();
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

    public function liked_books($id)
    {
        $liked_books = LikedBook::where('user_id', auth()->user()->id)->where('book_id', $id)->first();
        if ($liked_books) {
            $liked_books->delete();
            return back()->with('success', 'liked Deleted successfully');
        } else {
            $liked_books = new LikedBook();
            $liked_books->user_id = auth()->user()->id;
            $liked_books->book_id = $id;
            $liked_books->save();
        }
        return back()->with('success', 'Book liked successfully');
    }
    public function read_books($id)
    {
        $read = ReadBook::where('user_id', auth()->user()->id)->where('book_id', $id)->first();
        if (!$read) {
            $readbook = new ReadBook();
            $readbook->user_id = auth()->user()->id;
            $readbook->book_id = $id;
            $readbook->read_date = now();
            $readbook->save();
        }
        return true;
    }
}
