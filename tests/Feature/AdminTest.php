<?php

namespace Tests\Feature;

use App\Http\Controllers\Admin\BookingController;
use App\Models\Booking;
use App\Models\Event;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class AdminTest extends TestCase
{
    public function test_admin_dashboard_is_accessible(): void
    {
        $response = $this->get('/admin');

        $response->assertStatus(200);
    }

    public function test_confirmation_uses_the_admin_booking_confirmation_view(): void
    {
        Mail::fake();

        $event = Event::create([
            'title' => 'Sample Event',
            'description' => 'A sample event',
            'event_date' => now()->addDay(),
            'location' => 'Test Venue',
            'location_type' => 'inperson',
            'price' => 25.00,
            'capacity' => 20,
            'spots_remaining' => 20,
            'square_checkout_url' => 'https://example.com/checkout',
            'is_published' => true,
        ]);

        $booking = Booking::create([
            'event_id' => $event->id,
            'first_name' => 'Ada',
            'last_name' => 'Lovelace',
            'email' => 'ada@example.com',
            'phone' => '555-0123',
            'amount_paid' => 25.00,
            'status' => 'pending',
        ]);

        $response = (new BookingController())->confirmation($booking);

        $this->assertSame('admin.booking-confirmation', $response->name());
    }
}
