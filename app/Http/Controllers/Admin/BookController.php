<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Books, User};
use Illuminate\Http\Request;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Books::orderBy('id', 'desc')->get();
        // return $books;
        return view('admin.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::where('user_type', 'user')->where('is_author', 1)->OrderBy('id', 'DESC')->get();
        return view('admin.books.create')->with(compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'title' => 'required',
            'author_id' => 'required',
            'genre' => 'required',
            'publish_date' => 'required',
            'description' => 'required'
        ]);

        $books = new Books();
        $books->user_id = auth()->user()->id;
        $books->title = $request->title;
        $books->author_id = $request->author_id;
        $books->genre = $request->genre;
        $books->publish_date = $request->publish_date;
        $books->description = $request->description;
        $books->save();
        return redirect()->route('books.index')->with('success', 'Book created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Books::findOrFail($id);
        $users = User::where('user_type', 'user')->where('is_author', 1)->OrderBy('id', 'DESC')->get();
        return view('admin.books.edit', compact('book', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'title' => 'required',
            'author_id' => 'required',
            'genre' => 'required',
            'publish_date' => 'required',
            'description' => 'required'
        ]);

        $books = Books::findOrFail($id);
        $books->title = $request->title;
        $books->author_id = $request->author_id;
        $books->genre = $request->genre;
        $books->publish_date = $request->publish_date;
        $books->description = $request->description;
        $books->save();
        return redirect()->route('books.index')->with('success', 'Book Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $book = Books::findOrFail($request->id);
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully');
    }
}
