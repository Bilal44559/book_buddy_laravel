<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{Book, ReadBook, User};
use Illuminate\Support\Str;
use Illuminate\Http\Request;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::orderBy('id', 'desc')->get();
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
        $request->validate([
            'title' => 'required',
            'author_id' => 'required',
            'genre' => 'required',
            'publish_date' => 'required',
            'description' => 'required',
            'pdf_file' => 'mimes:pdf|max:2048'
        ]);

        $books = new Book();
        $slug = Str::slug($request->title, '-');
        $originalSlug = $slug;
        $counter = 1;
        while (Book::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        $books->slug = $slug;
        $books->user_id = auth()->user()->id;
        $books->title = $request->title;
        $books->author_id = $request->author_id;
        $books->genre = $request->genre;
        $books->publish_date = $request->publish_date;
        $books->description = $request->description;
        if ($request->hasFile('pdf_file')) {
            $books->file = $request->pdf_file->store('books', 'public');
        }
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
        $book = Book::findOrFail($id);
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

        $books = Book::findOrFail($id);
        $books->title = $request->title;
        $books->author_id = $request->author_id;
        $books->genre = $request->genre;
        $books->publish_date = $request->publish_date;
        $books->description = $request->description;
        if ($books->title !== $request->title or empty($books->slug)) {
            $slug = Str::slug($request->title, '-');
            $originalSlug = $slug;
            $counter = 1;
            while (Book::where('slug', $slug)->where('id', '!=', $books->id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
        } else {
            $slug = $books->slug;
        }

        if ($request->hasFile('pdf_file')) {
            if (!empty($books->file)) {
                \Storage::delete('public/' . $books->file);
            }
            $books->file = $request->pdf_file->store('books', 'public');
        }
        $books->slug = $slug;
        $books->save();
        return redirect()->route('books.index')->with('success', 'Book Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $book = Book::findOrFail($request->id);
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Book deleted successfully');
    }
}
