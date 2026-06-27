@extends('admin.layout')
@section('title', 'Bookings')

@section('content')
<div class="admin-header">
  <h1>Bookings</h1>
  <p>All event bookings in one place.</p>
</div>

<div class="admin-table-wrap">
  <table class="admin-table">
    <thead>
      <tr>
        <th>Name</th><th>Email</th><th>Event</th>
        <th>Amount</th><th>Status</th><th>Date</th>
      </tr>
    </thead>
    <tbody>
      @forelse($bookings as $booking)
      <tr>
        <td>{{ $booking->fullName() }}</td>
        <td>{{ $booking->email }}</td>
        <td>{{ $booking->event->title ?? '—' }}</td>
        <td>${{ number_format($booking->amount_paid, 2) }}</td>
        <td>
          <span class="badge {{ $booking->status === 'confirmed' ? 'badge-green' : ($booking->status === 'pending' ? 'badge-yellow' : 'badge-red') }}">
            {{ ucfirst($booking->status) }}
          </span>
        </td>
        <td>{{ $booking->created_at->format('d M Y') }}</td>
      </tr>
      @empty
      <tr><td colspan="6" style="text-align:center;color:var(--taupe);padding:40px;">No bookings yet.</td></tr>
      @endforelse
    </tbody>
  </table>
</div>
<div style="margin-top:20px;">{{ $bookings->links() }}</div>
@endsection