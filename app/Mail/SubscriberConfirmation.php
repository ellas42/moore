<?php

namespace App\Mail;

use App\Models\Subscriber;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

class SubscriberConfirmation extends Mailable
{
    public function __construct(public Subscriber $subscriber) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: "You're on the list!");
    }
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.subscriber-confirmation',
            with: ['name' => $this->subscriber->name],
        );
    }
}