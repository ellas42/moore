<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class AdminBookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('event')
            ->latest()
            ->paginate(20);

        return view('admin.bookings', compact('bookings'));
    }
}