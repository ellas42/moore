<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class AdminEventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('event_date', 'desc')->get();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'               => 'required|string|max:200',
            'description'         => 'required|string',
            'event_date'          => 'required|date|after:now',
            'location'            => 'required|string|max:200',
            'location_type'       => 'required|in:online,inperson',
            'price'               => 'required|numeric|min:0',
            'capacity'            => 'required|integer|min:1',
            'square_checkout_url' => 'nullable|url',
            'is_published'        => 'boolean',
        ]);

        $validated['spots_remaining'] = $validated['capacity'];
        $validated['is_published']    = $request->has('is_published');

        Event::create($validated);

        return redirect()->route('admin.events')
            ->with('success', 'Event created successfully.');
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $validated = $request->validate([
            'title'               => 'required|string|max:200',
            'description'         => 'required|string',
            'event_date'          => 'required|date',
            'location'            => 'required|string|max:200',
            'location_type'       => 'required|in:online,inperson',
            'price'               => 'required|numeric|min:0',
            'capacity'            => 'required|integer|min:1',
            'square_checkout_url' => 'nullable|url',
        ]);

        $validated['is_published'] = $request->has('is_published');

        // Recalculate spots if capacity changed
        if ($validated['capacity'] != $event->capacity) {
            $booked = $event->capacity - $event->spots_remaining;
            $validated['spots_remaining'] = max(0, $validated['capacity'] - $booked);
        }

        $event->update($validated);

        return redirect()->route('admin.events')
            ->with('success', 'Event updated successfully.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('admin.events')
            ->with('success', 'Event deleted.');
    }

    public function toggle(Event $event)
    {
        $event->update(['is_published' => !$event->is_published]);
        return back()->with('success',
            $event->is_published ? 'Event published.' : 'Event unpublished.'
        );
    }
}