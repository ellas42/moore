<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Mail\BookingConfirmation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->all();
        $type    = $payload['type'] ?? null;

        Log::info('Square webhook received', ['type' => $type]);

        // Payment completed
        if ($type === 'payment.completed') {
            $paymentId  = $payload['data']['object']['payment']['id'] ?? null;
            $orderId    = $payload['data']['object']['payment']['order_id'] ?? null;

            // Match booking by square_payment_id or find pending booking
            $booking = Booking::where('square_payment_id', $paymentId)
                ->orWhere('square_payment_id', $orderId)
                ->orWhere('status', 'pending')
                ->latest()
                ->first();

            if ($booking && $booking->status !== 'confirmed') {
                $booking->update([
                    'status'            => 'confirmed',
                    'square_payment_id' => $paymentId,
                ]);

                Mail::to($booking->email)
                    ->send(new BookingConfirmation($booking));

                Log::info('Booking confirmed via webhook', ['booking_id' => $booking->id]);
            }
        }

        return response()->json(['status' => 'ok']);
    }
}