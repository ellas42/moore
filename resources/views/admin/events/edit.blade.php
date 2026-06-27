@extends('admin.layout')
@section('title', 'Edit Event')

@section('content')
<div class="admin-header">
  <h1>Edit Event</h1>
  <p><a href="{{ route('admin.events') }}" style="color:var(--taupe);">← Back to Events</a></p>
</div>

<form method="POST" action="{{ route('admin.events.update', $event) }}" class="admin-form">
  @csrf @method('PUT')
  <div class="form-group">
    <label>Event Title</label>
    <input type="text" name="title" value="{{ old('title', $event->title) }}" required>
  </div>
  <div class="form-group">
    <label>Description</label>
    <textarea name="description" required>{{ old('description', $event->description) }}</textarea>
  </div>
  <div class="form-row-2">
    <div class="form-group">
      <label>Date & Time</label>
      <input type="datetime-local" name="event_date"
             value="{{ old('event_date', $event->event_date->format('Y-m-d\TH:i')) }}" required>
    </div>
    <div class="form-group">
      <label>Location Type</label>
      <select name="location_type" required>
        <option value="online"   {{ old('location_type', $event->location_type) === 'online'   ? 'selected' : '' }}>Online</option>
        <option value="inperson" {{ old('location_type', $event->location_type) === 'inperson' ? 'selected' : '' }}>In Person</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label>Location</label>
    <input type="text" name="location" value="{{ old('location', $event->location) }}" required>
  </div>
  <div class="form-row-2">
    <div class="form-group">
      <label>Price (AUD)</label>
      <input type="number" name="price" value="{{ old('price', $event->price) }}" step="0.01" min="0" required>
    </div>
    <div class="form-group">
      <label>Capacity</label>
      <input type="number" name="capacity" value="{{ old('capacity', $event->capacity) }}" min="1" required>
      <p class="form-hint">Currently {{ $event->spots_remaining }} spots remaining.</p>
    </div>
  </div>
  <div class="form-group">
    <label>Square Checkout URL</label>
    <input type="url" name="square_checkout_url"
           value="{{ old('square_checkout_url', $event->square_checkout_url) }}">
  </div>
  <div class="form-group">
    <div class="form-check">
      <input type="checkbox" name="is_published" id="is_published" value="1"
             {{ old('is_published', $event->is_published) ? 'checked' : '' }}>
      <label for="is_published">Published (visible on events page)</label>
    </div>
  </div>
  @if($errors->any())
    <div class="flash">
      @foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach
    </div>
  @endif
  <div class="form-actions">
    <button type="submit" class="btn-admin btn-admin-dark">Save Changes</button>
    <a href="{{ route('admin.events') }}" class="btn-admin btn-admin-ghost">Cancel</a>
  </div>
</form>
@endsection