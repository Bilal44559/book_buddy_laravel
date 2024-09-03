<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReadingChallenge;
use App\Models\Book;

class ReadingChallengeController extends Controller
{
    public function index()
    {
        $challenges = ReadingChallenge::with('books')->get();
        return view('admin.reading_challenges.index', compact('challenges'));
    }

    public function create()
    {
        $books = Book::where('is_active','1')->OrderBy('title', 'asc')->get();
        return view('admin.reading_challenges.create', compact('books'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'time_frame' => 'required',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'books' => 'required|array',
            'books.*' => 'exists:books,id',
        ]);

        // Handle icon upload if present
        $iconPath = null;
        if ($request->hasFile('icon')) {
            $iconPath = $request->file('icon')->store('challenge-icons', 'public');
        }

        // Create a new reading challenge
        $challenge = ReadingChallenge::create([
            'title' => $request->title,
            'description' => $request->description,
            'time_frame' => $request->time_frame,
            'icon' => $iconPath,
        ]);

        $challenge->books()->attach($request->books);

        return to_route('reading-challenges.index')->with('success', 'Reading Challenge created successfully!');
    }

    public function edit($id)
    {
        $challenge = ReadingChallenge::with('books')->findOrFail($id);
        $books = Book::where('is_active','1')->OrderBy('title', 'asc')->get();
        return view('admin.reading_challenges.edit', compact('challenge', 'books'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'time_frame' => 'required',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'books' => 'required|array',
        ]);

        $challenge = ReadingChallenge::findOrFail($id);

        if ($request->hasFile('icon')) {
            if ($challenge->icon) {
                \Storage::delete('public/' . $challenge->icon);
            }
            $iconPath = $request->file('icon')->store('challenge-icons', 'public');
            $challenge->icon = $iconPath;
        }

        $challenge->update([
            'title' => $request->title,
            'description' => $request->description,
            'time_frame' => $request->time_frame,
        ]);

        $challenge->books()->sync($request->books);

        return to_route('reading-challenges.index')->with('success', 'Reading Challenge updated successfully!');
    }

    public function destroy(Request $request)
    {
        $challenge = ReadingChallenge::findOrFail($request->id);
        if ($challenge->icon) {
            \Storage::delete('public/' . $challenge->icon);
        }
        $challenge->books()->detach();
        $challenge->delete();

        return to_route('reading-challenges.index')->with('success', 'Reading Challenge deleted successfully!');
    }
}
