<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');

        $events = Event::where('is_published', true)
            ->when($filter !== 'all', fn($q) =>
                $q->where('location_type', $filter)
            )
            ->orderBy('event_date')
            ->get();

        $hasEvents = $events->isNotEmpty();

        return view('events', compact('events', 'hasEvents', 'filter'));
    }
}