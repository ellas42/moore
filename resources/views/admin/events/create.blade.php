@extends('admin.layout')
@section('title', 'New Event')

@section('content')
<div class="admin-header">
  <h1>New Event</h1>
  <p><a href="{{ route('admin.events') }}" style="color:var(--taupe);">← Back to Events</a></p>
</div>

<form method="POST" action="{{ route('admin.events.store') }}" class="admin-form">
  @csrf
  <div class="form-group">
    <label>Event Title</label>
    <input type="text" name="title" value="{{ old('title') }}" required placeholder="Morning Journaling Circle">
  </div>
  <div class="form-group">
    <label>Description</label>
    <textarea name="description" required placeholder="Describe the event...">{{ old('description') }}</textarea>
  </div>
  <div class="form-row-2">
    <div class="form-group">
      <label>Date & Time</label>
      <input type="datetime-local" name="event_date" value="{{ old('event_date') }}" required>
    </div>
    <div class="form-group">
      <label>Location Type</label>
      <select name="location_type" required>
        <option value="online"   {{ old('location_type') === 'online'   ? 'selected' : '' }}>Online</option>
        <option value="inperson" {{ old('location_type') === 'inperson' ? 'selected' : '' }}>In Person</option>
      </select>
    </div>
  </div>
  <div class="form-group">
    <label>Location</label>
    <input type="text" name="location" value="{{ old('location') }}" required
           placeholder="Online via Zoom / Sydney, Australia">
  </div>
  <div class="form-row-2">
    <div class="form-group">
      <label>Price (AUD)</label>
      <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0" required placeholder="45.00">
    </div>
    <div class="form-group">
      <label>Capacity (total spots)</label>
      <input type="number" name="capacity" value="{{ old('capacity') }}" min="1" required placeholder="20">
    </div>
  </div>
  <div class="form-group">
    <label>Square Checkout URL</label>
    <input type="url" name="square_checkout_url" value="{{ old('square_checkout_url') }}"
           placeholder="https://square.link/u/xxxxxxxx">
    <p class="form-hint">Generate this from your Square dashboard → Online Checkout.</p>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input type="checkbox" name="is_published" id="is_published" value="1"
             {{ old('is_published') ? 'checked' : '' }}>
      <label for="is_published">Publish immediately (visible on the events page)</label>
    </div>
  </div>
  @if($errors->any())
    <div class="flash">
      @foreach($errors->all() as $error)
        <p>{{ $error }}</p>
      @endforeach
    </div>
  @endif
  <div class="form-actions">
    <button type="submit" class="btn-admin btn-admin-dark">Create Event</button>
    <a href="{{ route('admin.events') }}" class="btn-admin btn-admin-ghost">Cancel</a>
  </div>
</form>
@endsection