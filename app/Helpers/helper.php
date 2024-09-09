<?php

use App\Models\{Group,JoinedGroup,LikedBook,UserFollow};

function checkGroupJoined($group_id, $user_id)
{
    $joined = JoinedGroup::where('group_id', $group_id)->where('user_id', $user_id)->first();
    if ($joined) {
        return [
            'status' => 1,
            'data' => $joined
        ];
    } else {
        return [
            'status' => 0,
        ];
    }
}

function checkUserLikedBook($book_id)
{
    $liked = LikedBook::where('book_id', $book_id)->where('user_id', auth()->user()->id)->first();
    if ($liked) {
        return true;
    } else {
        return false;
    }
}

function checkUserFollowing($user_id)
{
    $follow = UserFollow::where('follower_user_id', auth()->user()->id)->where('following_user_id', $user_id)->first();
    if ($follow) {
        return true;
    } else {
        return false;
    }
}
