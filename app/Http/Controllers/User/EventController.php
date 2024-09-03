<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Group, Event, EventComment};

class EventController extends Controller
{
    public function index($id)
    {
        $group = Group::findOrFail($id);
        $events = Event::where('group_id', $group->id)->OrderBy('id', 'desc')->get();

        return view('user.groups.events.index')->with(compact('group', 'events'));
    }

    public function create($id)
    {
        $group = Group::findOrFail($id);

        return view('user.groups.events.create')->with(compact('group'));
    }

    public function store(Request $request, $groupId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|in:reading_session,discussion',
            'description' => 'nullable|string',
        ]);

        $group = Group::findOrFail($groupId);

        $event = new Event();
        $event->user_id = auth()->id();
        $event->group_id = $group->id;
        $event->name = $request->input('name');
        $event->type = $request->input('type');
        $event->description = $request->input('description');
        $event->is_active = true;

        $event->save();

        return redirect()->route('user.groups.events', $group->id)
            ->with('success', 'Event created successfully!');
    }

    public function edit($id, $event_id)
    {
        $group = Group::findOrFail($id);
        $event = Event::findOrFail($event_id);

        return view('user.groups.events.edit')->with(compact('group', 'event'));
    }

    public function update(Request $request, $groupId, $eventId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|in:reading_session,discussion',
            'description' => 'nullable|string',
        ]);

        $event = Event::where('group_id', $groupId)->findOrFail($eventId);

        $event->name = $request->input('name');
        $event->type = $request->input('type');
        $event->description = $request->input('description');

        $event->save();

        return redirect()->route('user.groups.events', $groupId)
            ->with('success', 'Event updated successfully!');
    }

    public function destroy($groupId, $eventId)
    {
        $event = Event::where('group_id', $groupId)->findOrFail($eventId);
        $event->delete();

        return redirect()->route('user.groups.events', $groupId)
            ->with('success', 'Event deleted successfully!');
    }

    public function detail($id, $event_id)
    {
        $group = Group::findOrFail($id);
        $event = Event::with('comments.user')->findOrFail($event_id);

        return view('user.groups.events.detail', compact('group', 'event'));
    }

    public function eventcomment_store(Request $request, $id)
    {

        $request->validate([
            'comment' => 'required|string|max:255',
        ]);

        $eventcomment = new EventComment();
        $eventcomment->user_id = auth()->id();
        $eventcomment->event_id = $id;
        $eventcomment->comment = $request->input('comment');
        $eventcomment->save();
        return redirect()->back()->with('success', 'Comment added successfully!');
    }
    public function eventcomment_reply_store(Request $request)
    {
        // return $request;

        $request->validate([
            'reply_comment' => 'required|string|max:255',
        ]);
        $comment = EventComment::findOrFail($request->input('comment_id'));
        $eventcomment = new EventComment();
        $eventcomment->user_id = auth()->id();
        $eventcomment->event_id = $comment->event_id;
        $eventcomment->comment = $request->input('reply_comment');
        $eventcomment->parent_id = $request->input('comment_id');
        $eventcomment->save();
        return redirect()->back()->with('success', 'Comment added successfully!');
    }
}
