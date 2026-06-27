@extends('layouts.app')

@section('title', 'Booking Confirmed — Mooré Connections')

@section('styles')
<style>
.confirmation-wrap {
  min-height: 80vh;
  display: flex; align-items: center; justify-content: center;
  padding: 120px 24px 80px;
  background: var(--base);
}
.confirmation-box {
  background: var(--white);
  border: 1px solid rgba(156,136,116,0.15);
  padding: 64px;
  max-width: 560px; width: 100%;
  text-align: center;
  position: relative;
}
.confirmation-flower {
  width: 100px; height: auto;
  margin-bottom: 28px;
}
.confirmation-check {
  font-size: 32px; margin-bottom: 16px;
  display: block;
}
.confirmation-heading {
  font-family: var(--serif);
  font-size: 38px; font-weight: 400;
  color: var(--dark); margin-bottom: 8px;
  line-height: 1.1;
}
.confirmation-heading em { font-style: italic; color: var(--taupe); }
.confirmation-sub {
  font-family: var(--sans); font-size: 13px; font-weight: 300;
  color: var(--taupe); letter-spacing: 1.5px;
  text-transform: uppercase; margin-bottom: 36px;
}
.confirmation-rule {
  width: 40px; height: 1px; background: var(--taupe);
  margin: 0 auto 36px;
}
.confirmation-details {
  background: var(--base);
  padding: 24px; text-align: left;
  margin-bottom: 36px;
}
.detail-row {
  display: flex; justify-content: space-between;
  padding: 8px 0;
  border-bottom: 1px solid rgba(156,136,116,0.12);
}
.detail-row:last-child { border-bottom: none; }
.detail-label {
  font-family: var(--sans); font-size: 11px; font-weight: 400;
  letter-spacing: 1.5px; text-transform: uppercase; color: var(--taupe);
}
.detail-value {
  font-family: var(--sans); font-size: 13px; font-weight: 400;
  color: var(--dark); text-align: right;
}
.confirmation-note {
  font-family: var(--sans); font-size: 13px; font-weight: 300;
  line-height: 1.8; color: var(--brown); margin-bottom: 36px;
}
</style>
@endsection

@section('content')
<div class="confirmation-wrap">
  <div class="confirmation-box">
    <img class="confirmation-flower"
         src="{{ asset('img/IMG_3864-removebg-preview.png') }}" alt="">
    <span class="confirmation-check">✦</span>
    <h1 class="confirmation-heading">Your spot is<br><em>reserved.</em></h1>
    <p class="confirmation-sub">Booking Confirmed</p>
    <div class="confirmation-rule"></div>

    <div class="confirmation-details">
      <div class="detail-row">
        <span class="detail-label">Name</span>
        <span class="detail-value">{{ $booking->fullName() }}</span>
      </div>
      <div class="detail-row">
        <span class="detail-label">Event</span>
        <span class="detail-value">{{ $booking->event->title }}</span>
      </div>
      <div class="detail-row">
        <span class="detail-label">Date</span>
        <span class="detail-value">{{ $booking->event->event_date->format('d M Y · g:i A') }}</span>
      </div>
      <div class="detail-row">
        <span class="detail-label">Location</span>
        <span class="detail-value">{{ $booking->event->location }}</span>
      </div>
      <div class="detail-row">
        <span class="detail-label">Amount Paid</span>
        <span class="detail-value">${{ number_format($booking->amount_paid, 2) }}</span>
      </div>
      <div class="detail-row">
        <span class="detail-label">Booking Ref</span>
        <span class="detail-value">#{{ str_pad($booking->id, 5, '0', STR_PAD_LEFT) }}</span>
      </div>
    </div>

    <p class="confirmation-note">
      A confirmation email has been sent to <strong>{{ $booking->email }}</strong>.
      We can't wait to see you there.
    </p>

    <a href="{{ route('home') }}" class="btn-dark">Back to Home</a>
  </div>
</div>
@endsection