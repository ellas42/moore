@extends('admin.layout')
@section('title', 'Dashboard')

@section('content')
<div class="admin-header">
  <h1>Good morning. ✦</h1>
  <p>Here's what's happening with Mooré Connections.</p>
</div>

<div class="stats-grid">
  <div class="stat-card">
    <p class="stat-label">Total Subscribers</p>
    <p class="stat-value">{{ $stats['total_subscribers'] }}</p>
    <p class="stat-sub">Active email subscribers</p>
  </div>
  <div class="stat-card">
    <p class="stat-label">Confirmed Bookings</p>
    <p class="stat-value">{{ $stats['confirmed_bookings'] }}</p>
    <p class="stat-sub">{{ $stats['total_bookings'] }} total</p>
  </div>
  <div class="stat-card">
    <p class="stat-label">Total Revenue</p>
    <p class="stat-value">${{ number_format($stats['total_revenue'], 0) }}</p>
    <p class="stat-sub">From confirmed bookings</p>
  </div>
  <div class="stat-card">
    <p class="stat-label">Live Events</p>
    <p class="stat-value">{{ $stats['published_events'] }}</p>
    <p class="stat-sub">{{ $stats['total_events'] }} total events</p>
  </div>
</div>

<div style="display:grid;grid-template-columns:1fr 1fr;gap:28px;">
  <div>
    <div class="section-header">
      <h2 class="section-title">Recent Bookings</h2>
      <a href="{{ route('admin.bookings') }}" class="btn-admin btn-admin-ghost">View All</a>
    </div>
    <div class="admin-table-wrap">
      <table class="admin-table">
        <thead>
          <tr><th>Name</th><th>Event</th><th>Status</th></tr>
        </thead>
        <tbody>
          @forelse($recent_bookings as $booking)
          <tr>
            <td>{{ $booking->fullName() }}</td>
            <td>{{ $booking->event->title ?? '—' }}</td>
            <td>
              <span class="badge {{ $booking->status === 'confirmed' ? 'badge-green' : ($booking->status === 'pending' ? 'badge-yellow' : 'badge-red') }}">
                {{ ucfirst($booking->status) }}
              </span>
            </td>
          </tr>
          @empty
          <tr><td colspan="3" style="color:var(--taupe);text-align:center;">No bookings yet</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>

  <div>
    <div class="section-header">
      <h2 class="section-title">Upcoming Events</h2>
      <a href="{{ route('admin.events.create') }}" class="btn-admin btn-admin-dark">+ New Event</a>
    </div>
    <div class="admin-table-wrap">
      <table class="admin-table">
        <thead>
          <tr><th>Event</th><th>Date</th><th>Spots</th></tr>
        </thead>
        <tbody>
          @forelse($upcoming_events as $event)
          <tr>
            <td>{{ $event->title }}</td>
            <td>{{ $event->event_date->format('d M Y') }}</td>
            <td>{{ $event->spots_remaining }}/{{ $event->capacity }}</td>
          </tr>
          @empty
          <tr><td colspan="3" style="color:var(--taupe);text-align:center;">No upcoming events</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection