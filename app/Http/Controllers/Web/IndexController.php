<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class IndexController extends Controller
{
    public function index()
    {
        $books = Book::where('is_active','1')->OrderBy('id','DESC')->get();
        return view("web.index")->with(compact('books'));
    }

    public function detail($id)
    {
        $book = Book::findOrFail($id);
        return view("web.detail")->with(compact('book'));
    }
}
