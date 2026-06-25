<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title', 'description', 'event_date',
        'location', 'location_type', 'price',
        'capacity', 'spots_remaining',
        'square_checkout_url', 'is_published',
    ];

    protected $casts = [
        'event_date'   => 'datetime',
        'is_published' => 'boolean',
        'price'        => 'decimal:2',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function isSoldOut(): bool
    {
        return $this->spots_remaining <= 0;
    }
}