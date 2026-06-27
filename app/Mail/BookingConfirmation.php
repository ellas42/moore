<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class BookingConfirmation extends Mailable
{
    public function __construct(public Booking $booking) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'Booking Confirmed!');
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.booking-confirmation',
            with: [
                'name'  => $this->booking->fullName(),
                'event' => $this->booking->event,
            ],
        );
    }
}