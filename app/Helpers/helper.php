<?php

use App\Models\{Group,JoinedGroup};

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