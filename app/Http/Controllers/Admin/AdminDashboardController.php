<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Booking;
use App\Models\Subscriber;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_events'      => Event::count(),
            'published_events'  => Event::where('is_published', true)->count(),
            'total_bookings'    => Booking::count(),
            'confirmed_bookings'=> Booking::where('status', 'confirmed')->count(),
            'total_subscribers' => Subscriber::count(),
            'total_revenue'     => Booking::where('status', 'confirmed')->sum('amount_paid'),
        ];

        $recent_bookings = Booking::with('event')
            ->latest()
            ->take(5)
            ->get();

        $upcoming_events = Event::where('is_published', true)
            ->where('event_date', '>=', now())
            ->orderBy('event_date')
            ->take(3)
            ->get();

        return view('admin.dashboard', compact('stats', 'recent_bookings', 'upcoming_events'));
    }
}