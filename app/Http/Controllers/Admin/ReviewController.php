<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;

class ReviewController extends Controller
{
    public function index()
    {
        $ratings = Rating::OrderBy('id', 'DESC')->get();
        return view('admin.reviews.index')->with(compact('ratings'));
    }

    public function delete(Request $request)
    {
        Rating::destroy($request->id);
        return back()->with('success', 'Rating deleted successfully!');
    }
}
