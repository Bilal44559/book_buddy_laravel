<?php

namespace App\Http\Controllers\User;

use App\Models\Group;
use App\Http\Controllers\Controller;
use App\Models\ReadBook;
use App\Models\ReadingChallenge;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AboutController extends Controller
{
    public function index()
    {
        // $groups = Group::get();
        $joined_groups_ids = auth()->user()->joined_groups->pluck('group_id');
        $groups = Group::whereIn('id', $joined_groups_ids)->where('is_active', '1')->OrderBy('id', 'DESC')->get();
        // return $groups;

        $userId = auth()->user()->id;
        $allAssignedBadges = [];

        $challenges = ReadingChallenge::with('books')->get();

        $readBooks = ReadBook::where('user_id', $userId)->get();

        foreach ($readBooks as $readBook) {
            $bookId = $readBook->book_id;
            $readDate = Carbon::parse($readBook->read_date);

            $challenges = ReadingChallenge::whereHas('books', function ($query) use ($bookId) {
                $query->where('book_id', $bookId);
            })->OrderBy('id', 'DESC')->get();
            // return $challenges;
            foreach ($challenges as $challenge) {
                // return $challenges;
                $startDate = Carbon::parse($challenge->created_at);
                $endDate = $startDate->copy();

                if ($challenge->time_frame == '1 week') {
                    $endDate->addWeek();
                } elseif ($challenge->time_frame == '1 month') {
                    $endDate->addMonth();
                }
                $startDate = $startDate->format('Y-m-d');
                $endDate = $endDate->format('Y-m-d');
                if ($readDate->between($startDate, $endDate)) {
                    $allAssignedBadges[] = $challenge;
                }
            }
        }
        // return $allAssignedBadges;
        return view('user.about.index', compact('groups', 'allAssignedBadges'));
    }
}
