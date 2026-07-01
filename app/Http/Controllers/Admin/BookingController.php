<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Event;
use App\Mail\BookingConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'event_id'   => 'required|exists:events,id',
            'first_name' => 'required|string|max:100',
            'last_name'  => 'required|string|max:100',
            'email'      => 'required|email',
            'phone'      => 'nullable|string|max:30',
        ]);

        $event = Event::findOrFail($validated['event_id']);

        if ($event->isSoldOut()) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, this event is sold out.',
            ], 422);
        }

        $booking = DB::transaction(function () use ($validated, $event) {
            $booking = Booking::create([
                ...$validated,
                'amount_paid' => $event->price,
                'status'      => 'pending',
            ]);
            $event->decrement('spots_remaining');
            return $booking;
        });

        // Redirect user to Square checkout ???
        //in-page payment supposedly
        return response()->json([
            'success'      => true,
            'checkout_url' => $event->square_checkout_url,
            'booking_id'   => $booking->id,
        ]);
    }

    public function confirmation(Booking $booking)
    {
        $booking->update(['status' => 'confirmed']);

        Mail::to($booking->email)
            ->send(new BookingConfirmation($booking));

        return view('admin.booking-confirmation', compact('booking'));
    }
}