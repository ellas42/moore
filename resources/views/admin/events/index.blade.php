@extends('admin.layout')
@section('title', 'Events')

@section('content')
<div class="section-header">
  <div class="admin-header" style="margin-bottom:0;">
    <h1>Events</h1>
    <p>Manage your events and gatherings.</p>
  </div>
  <a href="{{ route('admin.events.create') }}" class="btn-admin btn-admin-dark">+ New Event</a>
</div>

<div class="admin-table-wrap" style="margin-top:28px;">
  <table class="admin-table">
    <thead>
      <tr>
        <th>Title</th><th>Date</th><th>Type</th>
        <th>Price</th><th>Spots</th><th>Status</th><th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @forelse($events as $event)
      <tr>
        <td><strong>{{ $event->title }}</strong></td>
        <td>{{ $event->event_date->format('d M Y · g:i A') }}</td>
        <td>{{ ucfirst($event->location_type) }}</td>
        <td>${{ number_format($event->price, 2) }}</td>
        <td>{{ $event->spots_remaining }}/{{ $event->capacity }}</td>
        <td>
          <span class="badge {{ $event->is_published ? 'badge-green' : 'badge-grey' }}">
            {{ $event->is_published ? 'Live' : 'Draft' }}
          </span>
        </td>
        <td style="display:flex;gap:8px;flex-wrap:wrap;">
          <a href="{{ route('admin.events.edit', $event) }}"
             class="btn-admin btn-admin-ghost">Edit</a>
          <form method="POST" action="{{ route('admin.events.toggle', $event) }}">
            @csrf @method('PATCH')
            <button type="submit" class="btn-admin btn-admin-ghost">
              {{ $event->is_published ? 'Unpublish' : 'Publish' }}
            </button>
          </form>
          <form method="POST" action="{{ route('admin.events.destroy', $event) }}"
                onsubmit="return confirm('Delete this event?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn-admin btn-admin-danger">Delete</button>
          </form>
        </td>
      </tr>
      @empty
      <tr>
        <td colspan="7" style="text-align:center;color:var(--taupe);padding:40px;">
          No events yet. <a href="{{ route('admin.events.create') }}"
          style="color:var(--dark);">Create your first event →</a>
        </td>
      </tr>
      @endforelse
    </tbody>
  </table>
</div>
@endsection