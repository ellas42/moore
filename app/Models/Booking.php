<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'event_id', 'first_name', 'last_name',
        'email', 'phone', 'amount_paid',
        'square_payment_id', 'status',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function fullName(): string
    {
        return "{$this->first_name} {$this->last_name}";
    }
}