<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Group, JoinedGroup};

class GroupController extends Controller
{
    public function index()
    {
        $groups = Group::where('user_id', auth()->user()->id)->where('is_active', '1')->OrderBy('id', 'DESC')->get();
        return view('user.groups.index')->with(compact('groups'));
    }

    public function create()
    {
        return view('user.groups.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $slug = \Str::slug(str_replace(' ', '-', $request->name));

        $originalSlug = $slug;
        $count = 1;
        while (Group::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $group = new Group();
        $group->user_id = auth()->user()->id;
        $group->name = $request->name;
        $group->slug = $slug;
        $group->description = $request->description;
        $group->is_active = '1';

        if ($group->save()) {
            $joined_group = new JoinedGroup();
            $joined_group->user_id = auth()->user()->id;
            $joined_group->group_id = $group->id;
            $joined_group->is_admin = true;
            $joined_group->status = "accepted";
            $joined_group->save();

            return redirect()->route('user.groups.index')->with('success', 'Group created successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to create the group. Please try again.');
        }
    }

    public function edit($id)
    {
        $group = Group::find($id);
        return view('user.groups.edit')->with(compact('group'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $group = Group::findOrFail($id);

        $slug = \Str::slug(str_replace(' ', '-', $request->name));
        $originalSlug = $slug;
        $count = 1;
        while (Group::where('slug', $slug)->where('id', '!=', $group->id)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        $group->name = $request->name;
        $group->slug = $slug;
        $group->description = $request->description;
        $group->is_active = 1;

        if ($group->save()) {
            return to_route('user.groups.index')->with('success', 'Group updated successfully');
        } else {
            return back()->with('error', 'Failed to update the group. Please try again.');
        }
    }


    public function delete(Request $request)
    {
        JoinedGroup::where('group_id', $request->id)->delete();
        $group = Group::destroy($request->id);
        return back()->with('success', 'Group deleted successfully!');
    }

    public function view_all($status)
    {
        if ($status == "all") {
            $groups = Group::where('is_active', '1')->OrderBy('id', 'DESC')->get();
        } else {
            $joined_groups_ids = auth()->user()->joined_groups->pluck('group_id');
            $groups = Group::whereIn('id', $joined_groups_ids)->where('is_active', '1')->OrderBy('id', 'DESC')->get();
        }
        return view('user.groups.view_all')->with(compact('groups'));
    }

    public function request_store($id)
    {
        $joined_group = new JoinedGroup();
        $joined_group->user_id = auth()->user()->id;
        $joined_group->group_id = $id;
        $joined_group->is_admin = false;
        $joined_group->save();

        return back()->with('success', 'Request sent successfully!');
    }

    public function group_members($id)
    {
        $group = Group::findOrFail($id);

        return view('user.groups.members')->with(compact('group'));
    }

    public function group_status_update(Request $request)
    {
        $joined_group = JoinedGroup::findOrFail($request->id);

        if ($joined_group->status == "accepted") {
            $joined_group->status = "declined";
        } else {
            $joined_group->status = "accepted";
        }

        $joined_group->save();

        return back()->with('success', 'Status updated successfully!');
    }
}
