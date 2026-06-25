@component('mail::message')
# Your spot is reserved. ✦

Hi {{ $name }},

Your booking for **{{ $event->title }}** is confirmed.

**Date:** {{ $event->event_date->format('d M Y · g:i A') }}
**Location:** {{ $event->location }}
**Deposit paid:** ${{ number_format($event->price, 2) }}

We can't wait to see you there.

*With love,*
**Mooré Connections**
@endcomponent