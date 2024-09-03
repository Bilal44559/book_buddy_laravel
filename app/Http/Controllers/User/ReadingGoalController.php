<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ReadingGoal;
use Illuminate\Support\Facades\Auth;

class ReadingGoalController extends Controller
{
    public function index()
    {
        $readingGoals = ReadingGoal::where('user_id', Auth::id())
            ->where('year', date('Y'))
            ->first();

        return view('user.reading_goals.index', compact('readingGoals'));
    }

    public function create()
    {
        $readingGoals = ReadingGoal::where('user_id', Auth::id())
            ->where('year', date('Y'))
            ->first();
        return view('user.reading_goals.create')->with(compact('readingGoals'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'goal' => 'required|integer|min:1',
        ]);

        ReadingGoal::updateOrCreate(
            ['user_id' => Auth::id(), 'year' => date('Y')],
            ['goal' => $request->goal]
        );

        return to_route('user.reading-goals.index')->with('success', 'Reading goal set successfully!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'goal' => 'required|integer|min:0',
        ]);

        $readingGoal = ReadingGoal::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $readingGoal->update(['goal' => $request->goal]);

        return to_route('user.reading-goals.index')->with('success', 'Reading goal updated successfully!');
    }
}
