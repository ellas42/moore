@extends('layouts.app')

@section('title', 'Events — Mooré Connections')

@section('styles')
<style>
:root { --base: #FAF7F2; --blush: #F0E8DC; --taupe: #9C8874; --brown: #6B4F3A; --dark: #2C1A0E; --white: #FFFFFF; --serif: 'Cormorant Garamond', Georgia, serif; --sans: 'DM Sans', sans-serif; }
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
body { font-family: var(--sans); background: var(--base); color: var(--dark); overflow-x: hidden; }
.reveal { opacity: 0; transform: translateY(24px); transition: opacity 0.75s ease, transform 0.75s ease; }
.reveal.visible { opacity: 1; transform: translateY(0); }
.reveal-delay-1 { transition-delay: 0.1s; }
.reveal-delay-2 { transition-delay: 0.22s; }
.reveal-delay-3 { transition-delay: 0.34s; }
.nav { position: fixed; top: 0; left: 0; right: 0; z-index: 200; display: flex; align-items: center; justify-content: space-between; padding: 22px 56px; background: rgba(250,247,242,0.95); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border-bottom: 1px solid rgba(156,136,116,0.15); }
.nav-logo img { height: 46px; width: auto; display: block; }
.nav-links { display: flex; gap: 40px; list-style: none; }
.nav-links a { font-family: var(--sans); font-size: 11px; font-weight: 400; letter-spacing: 2.2px; text-transform: uppercase; color: var(--dark); text-decoration: none; transition: color 0.2s; }
.nav-links a:hover, .nav-links a.active { color: var(--taupe); }
.nav-book { font-family: var(--sans); font-size: 11px; font-weight: 500; letter-spacing: 1.8px; text-transform: uppercase; color: var(--white); background: var(--dark); padding: 12px 30px; text-decoration: none; transition: background 0.25s; }
.nav-book:hover { background: var(--brown); }
.page-hero { background: var(--blush); padding: 160px 56px 80px; position: relative; overflow: hidden; }
.page-hero-inner { max-width: 1080px; margin: 0 auto; display: grid; grid-template-columns: 1fr auto; align-items: flex-end; gap: 40px; }
.page-hero-flower { width: 240px; height: auto; opacity: 0; animation: fadeScale 1s 0.3s ease forwards; }
@keyframes fadeScale { from { opacity: 0; transform: scale(0.93); } to { opacity: 1; transform: scale(1); } }
.page-label { font-family: var(--sans); font-size: 10px; font-weight: 400; letter-spacing: 3.5px; text-transform: uppercase; color: var(--taupe); margin-bottom: 16px; display: block; opacity: 0; animation: fadeUp 0.8s 0.15s ease forwards; }
.page-heading { font-family: var(--serif); font-size: clamp(40px, 6vw, 72px); font-weight: 400; line-height: 1.08; color: var(--dark); opacity: 0; animation: fadeUp 0.8s 0.28s ease forwards; }
.page-heading em { font-style: italic; color: var(--taupe); }
.page-subtext { font-family: var(--sans); font-size: 15px; font-weight: 300; line-height: 1.8; color: var(--brown); max-width: 480px; margin-top: 24px; opacity: 0; animation: fadeUp 0.8s 0.42s ease forwards; }
@keyframes fadeUp { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: translateY(0); } }
.demo-toggle { background: var(--white); border-bottom: 1px solid rgba(156,136,116,0.15); padding: 16px 56px; display: flex; align-items: center; gap: 20px; }
.demo-toggle span { font-size: 11px; letter-spacing: 1.5px; text-transform: uppercase; color: var(--taupe); font-family: var(--sans); }
.toggle-btn { font-family: var(--sans); font-size: 11px; font-weight: 400; letter-spacing: 1.5px; text-transform: uppercase; padding: 8px 20px; border: 1px solid rgba(156,136,116,0.4); background: transparent; cursor: pointer; color: var(--brown); transition: all 0.2s; }
.toggle-btn.active { background: var(--dark); color: var(--white); border-color: var(--dark); }
.events-main { padding: 80px 56px 120px; }
.inner { max-width: 1080px; margin: 0 auto; }
#emptyState { display: grid; grid-template-columns: 1fr 1fr; gap: 100px; align-items: center; min-height: 480px; }
.empty-visual { position: relative; display: flex; align-items: center; justify-content: center; }
.empty-flower-main { width: 82%; max-width: 380px; }
.empty-flower-sm { position: absolute; bottom: -10px; right: -10px; width: 36%; opacity: 0.7; }
.empty-eyebrow { font-family: var(--sans); font-size: 10px; font-weight: 400; letter-spacing: 3px; text-transform: uppercase; color: var(--taupe); margin-bottom: 20px; display: block; }
.empty-heading { font-family: var(--serif); font-size: clamp(28px, 3.5vw, 44px); font-weight: 400; line-height: 1.2; color: var(--dark); margin-bottom: 20px; }
.empty-heading em { font-style: italic; color: var(--taupe); }
.empty-body { font-family: var(--sans); font-size: 15px; font-weight: 300; line-height: 1.85; color: var(--brown); margin-bottom: 44px; max-width: 420px; }
.rule { width: 40px; height: 1px; background: var(--taupe); margin: 28px 0; }
.subscribe-box { background: var(--white); border: 1px solid rgba(156,136,116,0.15); padding: 40px; max-width: 440px; }
.subscribe-box-title { font-family: var(--serif); font-size: 22px; font-weight: 400; color: var(--dark); margin-bottom: 6px; }
.subscribe-box-sub { font-family: var(--sans); font-size: 12px; font-weight: 300; color: var(--taupe); margin-bottom: 28px; line-height: 1.6; }
.subscribe-form { display: flex; flex-direction: column; gap: 12px; }
.subscribe-form input { font-family: var(--sans); font-size: 13px; font-weight: 300; color: var(--dark); background: var(--base); border: 1px solid rgba(156,136,116,0.25); padding: 13px 16px; outline: none; width: 100%; transition: border-color 0.2s; -webkit-appearance: none; }
.subscribe-form input::placeholder { color: rgba(107,79,58,0.4); }
.subscribe-form input:focus { border-color: var(--taupe); background: var(--white); }
.subscribe-form button { font-family: var(--sans); font-size: 11px; font-weight: 500; letter-spacing: 2px; text-transform: uppercase; color: var(--white); background: var(--dark); border: none; padding: 15px; cursor: pointer; transition: background 0.25s; width: 100%; }
.subscribe-form button:hover { background: var(--brown); }
.subscribe-note { font-size: 11px; color: var(--taupe); font-family: var(--sans); font-weight: 300; line-height: 1.6; }
.subscribe-success { display: none; text-align: center; padding: 12px 0; }
.subscribe-success-text { font-family: var(--serif); font-style: italic; font-size: 20px; color: var(--taupe); display: block; margin-bottom: 8px; }
.subscribe-success-sub { font-family: var(--sans); font-size: 12px; font-weight: 300; color: var(--brown); }
#activeState { display: none; }
.events-filter { display: flex; gap: 8px; margin-bottom: 48px; flex-wrap: wrap; }
.filter-btn { font-family: var(--sans); font-size: 10px; font-weight: 400; letter-spacing: 2px; text-transform: uppercase; padding: 9px 22px; border: 1px solid rgba(156,136,116,0.3); background: transparent; cursor: pointer; color: var(--brown); transition: all 0.2s; }
.filter-btn.active, .filter-btn:hover { background: var(--dark); color: var(--white); border-color: var(--dark); }
.events-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px; }
.event-card { background: var(--white); border: 1px solid rgba(156,136,116,0.1); display: flex; flex-direction: column; transition: box-shadow 0.3s, transform 0.3s; overflow: hidden; }
.event-card:hover { box-shadow: 0 12px 40px rgba(44,26,14,0.09); transform: translateY(-4px); }
.event-card-img { position: relative; height: 200px; background: var(--blush); display: flex; align-items: center; justify-content: center; overflow: hidden; }
.event-card-flower { height: 160px; width: auto; object-fit: contain; transition: transform 0.5s ease; }
.event-card:hover .event-card-flower { transform: scale(1.05); }
.event-card-badge { position: absolute; top: 16px; left: 16px; font-family: var(--sans); font-size: 9px; font-weight: 500; letter-spacing: 2px; text-transform: uppercase; color: var(--white); background: var(--dark); padding: 5px 12px; }
.event-card-badge.sold-out { background: rgba(107,79,58,0.7); }
.event-card-body { padding: 28px; flex: 1; display: flex; flex-direction: column; }
.event-card-meta { display: flex; gap: 16px; margin-bottom: 14px; flex-wrap: wrap; }
.event-meta-item { font-family: var(--sans); font-size: 10.5px; font-weight: 300; color: var(--taupe); display: flex; align-items: center; gap: 5px; }
.event-card-name { font-family: var(--serif); font-size: 22px; font-weight: 400; color: var(--dark); margin-bottom: 10px; line-height: 1.2; }
.event-card-desc { font-family: var(--sans); font-size: 13px; font-weight: 300; line-height: 1.7; color: var(--brown); flex: 1; }
.event-card-footer { display: flex; align-items: center; justify-content: space-between; margin-top: 24px; padding-top: 20px; border-top: 1px solid rgba(156,136,116,0.15); }
.event-price { font-family: var(--serif); font-style: italic; font-size: 20px; color: var(--dark); }
.event-spots { font-family: var(--sans); font-size: 10px; font-weight: 300; color: var(--taupe); letter-spacing: 1px; }
.btn-book { font-family: var(--sans); font-size: 11px; font-weight: 500; letter-spacing: 2px; text-transform: uppercase; color: var(--white); background: var(--dark); padding: 12px 28px; text-decoration: none; display: inline-block; transition: background 0.25s; border: none; cursor: pointer; }
.btn-book:hover { background: var(--brown); }
.btn-book:disabled, .btn-book.sold-out { background: rgba(156,136,116,0.4); cursor: not-allowed; }
.subscribe-strip { margin-top: 80px; background: var(--blush); padding: 56px 48px; display: grid; grid-template-columns: 1fr auto; gap: 48px; align-items: center; }
.strip-text h3 { font-family: var(--serif); font-size: 28px; font-weight: 400; font-style: italic; color: var(--dark); margin-bottom: 8px; }
.strip-text p { font-family: var(--sans); font-size: 13px; font-weight: 300; color: var(--brown); line-height: 1.7; }
.strip-form { display: flex; gap: 0; min-width: 380px; }
.strip-form input { font-family: var(--sans); font-size: 13px; font-weight: 300; color: var(--dark); background: var(--white); border: 1px solid rgba(156,136,116,0.3); border-right: none; padding: 13px 18px; outline: none; flex: 1; transition: border-color 0.2s; }
.strip-form input:focus { border-color: var(--taupe); }
.strip-form button { font-family: var(--sans); font-size: 11px; font-weight: 500; letter-spacing: 2px; text-transform: uppercase; color: var(--white); background: var(--dark); border: none; padding: 13px 28px; cursor: pointer; white-space: nowrap; transition: background 0.25s; }
.strip-form button:hover { background: var(--brown); }
.modal-overlay { position: fixed; inset: 0; z-index: 500; background: rgba(44,26,14,0.5); backdrop-filter: blur(6px); display: flex; align-items: center; justify-content: center; opacity: 0; pointer-events: none; transition: opacity 0.3s; padding: 24px; }
.modal-overlay.open { opacity: 1; pointer-events: all; }
.modal { background: var(--white); width: 100%; max-width: 560px; max-height: 90vh; overflow-y: auto; transform: translateY(20px); transition: transform 0.35s ease; }
.modal-overlay.open .modal { transform: translateY(0); }
.modal-header { padding: 36px 40px 24px; border-bottom: 1px solid rgba(156,136,116,0.15); display: flex; justify-content: space-between; align-items: flex-start; }
.modal-title { font-family: var(--serif); font-size: 28px; font-weight: 400; color: var(--dark); line-height: 1.2; }
.modal-event-name { font-family: var(--sans); font-size: 11px; font-weight: 300; letter-spacing: 1.5px; text-transform: uppercase; color: var(--taupe); margin-top: 4px; }
.modal-close { background: none; border: none; cursor: pointer; font-size: 22px; color: var(--taupe); line-height: 1; padding: 4px; transition: color 0.2s; margin-left: 16px; flex-shrink: 0; }
.modal-close:hover { color: var(--dark); }
.modal-body { padding: 32px 40px 40px; }
.modal-section-title { font-family: var(--sans); font-size: 10px; font-weight: 500; letter-spacing: 2.5px; text-transform: uppercase; color: var(--taupe); margin-bottom: 18px; }
.modal-form { display: flex; flex-direction: column; gap: 14px; }
.form-group { display: flex; flex-direction: column; gap: 6px; }
.form-group label { font-family: var(--sans); font-size: 11px; font-weight: 400; letter-spacing: 1.5px; text-transform: uppercase; color: var(--brown); }
.form-group input, .form-group select { font-family: var(--sans); font-size: 13px; font-weight: 300; color: var(--dark); background: var(--base); border: 1px solid rgba(156,136,116,0.25); padding: 13px 16px; outline: none; width: 100%; transition: border-color 0.2s; -webkit-appearance: none; border-radius: 0; }
.form-group input:focus, .form-group select:focus { border-color: var(--taupe); background: var(--white); }
.form-row-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
.order-summary { background: var(--base); padding: 20px; margin: 24px 0; border: 1px solid rgba(156,136,116,0.15); }
.order-row { display: flex; justify-content: space-between; align-items: center; padding: 7px 0; }
.order-row-label { font-family: var(--sans); font-size: 13px; font-weight: 300; color: var(--brown); }
.order-row-value { font-family: var(--sans); font-size: 13px; font-weight: 400; color: var(--dark); }
.order-divider { border: none; border-top: 1px solid rgba(156,136,116,0.2); margin: 8px 0; }
.order-total-label { font-family: var(--sans); font-size: 11px; font-weight: 500; letter-spacing: 1.5px; text-transform: uppercase; color: var(--dark); }
.order-total-value { font-family: var(--serif); font-size: 22px; color: var(--dark); }
.square-container { margin: 20px 0; min-height: 90px; background: var(--base); border: 1px solid rgba(156,136,116,0.2); display: flex; align-items: center; justify-content: center; }
.square-placeholder { font-family: var(--sans); font-size: 12px; font-weight: 300; color: var(--taupe); letter-spacing: 1px; }
.modal-submit { font-family: var(--sans); font-size: 11px; font-weight: 500; letter-spacing: 2px; text-transform: uppercase; color: var(--white); background: var(--dark); border: none; padding: 16px; cursor: pointer; width: 100%; transition: background 0.25s; margin-top: 8px; }
.modal-submit:hover { background: var(--brown); }
.modal-secure { font-family: var(--sans); font-size: 11px; font-weight: 300; color: var(--taupe); text-align: center; margin-top: 14px; }
footer { background: var(--white); border-top: 1px solid rgba(156,136,116,0.15); padding: 52px 56px 36px; }
.footer-inner { max-width: 1080px; margin: 0 auto; display: grid; grid-template-columns: auto 1fr auto; gap: 48px; align-items: center; }
.footer-logo img { height: 42px; }
.footer-links { display: flex; justify-content: center; gap: 36px; list-style: none; }
.footer-links a { font-size: 10px; letter-spacing: 2px; text-transform: uppercase; color: var(--brown); text-decoration: none; font-family: var(--sans); transition: color 0.2s; }
.footer-links a:hover { color: var(--dark); }
.footer-copy { font-size: 11px; color: var(--taupe); font-family: var(--sans); font-weight: 300; text-align: right; }
@media (max-width: 960px) { .nav { padding: 18px 24px; } .nav-links { display: none; } .page-hero { padding: 130px 24px 60px; } .page-hero-inner { grid-template-columns: 1fr; } .page-hero-flower { width: 160px; } .events-main { padding: 56px 24px 80px; } #emptyState { grid-template-columns: 1fr; gap: 48px; } .events-grid { grid-template-columns: 1fr 1fr; } .subscribe-strip { grid-template-columns: 1fr; gap: 28px; } .strip-form { min-width: unset; } .footer-inner { grid-template-columns: 1fr; text-align: center; gap: 20px; } .footer-links { justify-content: center; } .footer-copy { text-align: center; } .demo-toggle { padding: 14px 24px; } .modal-header { padding: 28px 24px 20px; } .modal-body { padding: 24px 24px 32px; } .form-row-2 { grid-template-columns: 1fr; } }
@media (max-width: 600px) { .events-grid { grid-template-columns: 1fr; } }
@media (prefers-reduced-motion: reduce) { .reveal { transition: none; opacity: 1; transform: none; } }
</style>
@endsection

@section('content')

<!-- PAGE HERO -->
<section class="page-hero">
  <div class="page-hero-inner">
    <div>
      <span class="page-label">Mooré Connections</span>
      <h1 class="page-heading">Events &amp;<br><em>Gatherings.</em></h1>
      <p class="page-subtext">
        Intentional spaces to gather, journal, breathe, and reconnect —
        with yourself and with others who are walking the same path.
      </p>
    </div>
    <img class="page-hero-flower"
         src="{{ asset('img/IMG_3865-removebg-preview.png') }}" alt="">
  </div>
</section>

<section class="events-main">
  <div class="inner">

    @if($hasEvents)

      {{-- FILTER BAR --}}
      <div class="events-filter">
        <a href="{{ route('events') }}"
           class="filter-btn {{ $filter === 'all' ? 'active' : '' }}">All Events</a>
        <a href="{{ route('events', ['filter' => 'online']) }}"
           class="filter-btn {{ $filter === 'online' ? 'active' : '' }}">Online</a>
        <a href="{{ route('events', ['filter' => 'inperson']) }}"
           class="filter-btn {{ $filter === 'inperson' ? 'active' : '' }}">In Person</a>
      </div>

      {{-- EVENT CARDS --}}
      <div class="events-grid">
        @foreach($events as $event)
        <div class="event-card reveal" data-type="{{ $event->location_type }}">
          <div class="event-card-img">
            <img class="event-card-flower"
                 src="{{ asset('img/IMG_3864-removebg-preview.png') }}" alt="">
            <span class="event-card-badge {{ $event->isSoldOut() ? 'sold-out' : '' }}">
              {{ $event->isSoldOut() ? 'Sold Out' : ucfirst($event->location_type) }}
            </span>
          </div>
          <div class="event-card-body">
            <div class="event-card-meta">
              <span class="event-meta-item">📅 {{ $event->event_date->format('d M Y') }}</span>
              <span class="event-meta-item">🕐 {{ $event->event_date->format('g:i A') }}</span>
            </div>
            <h3 class="event-card-name">{{ $event->title }}</h3>
            <p class="event-card-desc">{{ $event->description }}</p>
            <div class="event-card-footer">
              <div>
                <p class="event-price">${{ number_format($event->price, 2) }}</p>
                <p class="event-spots">{{ $event->spots_remaining }} spots remaining</p>
              </div>
              @if($event->isSoldOut())
                <button class="btn-book sold-out" disabled>Sold Out</button>
              @else
                <button class="btn-book" onclick="openModal(
                  {{ $event->id }},
                  '{{ addslashes($event->title) }}',
                  '${{ number_format($event->price, 2) }}',
                  '{{ $event->event_date->format('d M Y · g:i A') }}',
                  '{{ addslashes($event->location) }}'
                )">Book Now</button>
              @endif
            </div>
          </div>
        </div>
        @endforeach
      </div>

      {{-- SUBSCRIBE STRIP --}}
      <div class="subscribe-strip">
        <div class="strip-text">
          <h3>Don't miss the next one.</h3>
          <p>Get a quiet email when new events are announced.</p>
        </div>
        <form class="strip-form" id="stripForm">
          <input type="text" name="name" placeholder="Your name" required>
          <input type="email" name="email" placeholder="Your email" required>
          <button type="submit">Notify Me</button>
        </form>
      </div>

    @else

      {{-- EMPTY STATE --}}
      <div id="emptyState">
        <div class="empty-visual reveal">
          <img class="empty-flower-main"
               src="{{ asset('img/IMG_3864-removebg-preview.png') }}" alt="">
          <img class="empty-flower-sm"
               src="{{ asset('img/IMG_3869-removebg-preview.png') }}" alt="">
        </div>
        <div>
          <span class="empty-eyebrow reveal">Coming Soon</span>
          <h2 class="empty-heading reveal reveal-delay-1">
            Something <em>beautiful</em><br>is being planned.
          </h2>
          <div class="rule reveal reveal-delay-2"></div>
          <p class="empty-body reveal reveal-delay-2">
            Madison is currently designing experiences that will bring people
            together in meaningful ways — journaling circles, immersion days,
            and intimate group gatherings.
          </p>
          <p class="empty-body reveal reveal-delay-3">
            No events are live just yet. Leave your details below and you'll
            be the very first to know when something's announced.
          </p>
          <div class="subscribe-box reveal reveal-delay-3" id="subscribe">
            <p class="subscribe-box-title">Be the first to know.</p>
            <p class="subscribe-box-sub">A quiet note when something's ready — no spam, ever.</p>
            <form class="subscribe-form" id="emptySubscribeForm">
              @csrf
              <input type="text" name="name" placeholder="Your first name" required>
              <input type="email" name="email" placeholder="Your email address" required>
              <button type="submit">Notify Me When Events Are Live</button>
              <p class="subscribe-note">You can unsubscribe any time.</p>
              <div class="subscribe-success" id="emptySuccess">
                <span class="subscribe-success-text">You're on the list. ✦</span>
                <span class="subscribe-success-sub">We'll reach out as soon as something's scheduled.</span>
              </div>
            </form>
          </div>
        </div>
      </div>

    @endif

  </div>
</section>

{{-- BOOKING MODAL --}}
<div class="modal-overlay" id="modalOverlay">
  <div class="modal" role="dialog" aria-modal="true">
    <div class="modal-header">
      <div>
        <h2 class="modal-title">Reserve Your Spot</h2>
        <p class="modal-event-name" id="modalEventName"></p>
      </div>
      <button class="modal-close" onclick="closeModal()">✕</button>
    </div>
    <div class="modal-body">
      <form id="bookingForm">
        @csrf
        <input type="hidden" name="event_id" id="bookingEventId">
        <p class="modal-section-title">Your Details</p>
        <div class="form-row-2">
          <div class="form-group">
            <label>First Name</label>
            <input type="text" name="first_name" required>
          </div>
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="last_name" required>
          </div>
        </div>
        <div class="form-group" style="margin-top:14px;">
          <label>Email Address</label>
          <input type="email" name="email" required>
        </div>
        <div class="form-group" style="margin-top:14px;">
          <label>Phone (optional)</label>
          <input type="tel" name="phone">
        </div>
        <div class="order-summary">
          <div class="order-row">
            <span class="order-row-label" id="orderEventName"></span>
            <span class="order-row-value" id="orderEventPrice"></span>
          </div>
          <div class="order-row">
            <span class="order-row-label" id="orderDate"></span>
            <span class="order-row-value" id="orderLocation"></span>
          </div>
          <hr class="order-divider">
          <div class="order-row">
            <span class="order-total-label">Total</span>
            <span class="order-total-value" id="orderTotal"></span>
          </div>
        </div>
        <p class="modal-section-title">Payment</p>
        <div class="square-container" id="card-container">
          {{-- Square Web Payments SDK mounts here --}}
        </div>
        <p id="payment-status-container"></p>
        <button type="button" class="modal-submit" id="modalSubmit">
          Complete Booking
        </button>
        <p class="modal-secure">🔒 Secured by Square. We never store card details.</p>
      </form>
    </div>
  </div>
</div>

@endsection

@section('scripts')
<script src="https://sandbox.web.squarecdn.com/v1/square.js"></script>
<script>
// Reveal on scroll
const observer = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); }
  });
}, { threshold: 0.1 });
document.querySelectorAll('.reveal').forEach(el => observer.observe(el));

// Modal
let payments, card;

async function initSquare() {
  if (typeof Square === 'undefined') return;
  payments = Square.payments('{{ config("services.square.app_id") }}', '{{ config("services.square.location_id") }}');
  card = await payments.card();
  await card.attach('#card-container');
}
initSquare();

function openModal(eventId, name, price, date, location) {
  document.getElementById('bookingEventId').value  = eventId;
  document.getElementById('modalEventName').textContent  = name;
  document.getElementById('orderEventName').textContent  = name;
  document.getElementById('orderEventPrice').textContent = price;
  document.getElementById('orderDate').textContent       = date;
  document.getElementById('orderLocation').textContent   = location;
  document.getElementById('orderTotal').textContent      = price;
  document.getElementById('modalOverlay').classList.add('open');
  document.body.style.overflow = 'hidden';
}
function closeModal() {
  document.getElementById('modalOverlay').classList.remove('open');
  document.body.style.overflow = '';
}
document.getElementById('modalOverlay').addEventListener('click', (e) => {
  if (e.target === e.currentTarget) closeModal();
});
document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeModal(); });

// Booking submit
document.getElementById('modalSubmit').addEventListener('click', async () => {
  const btn = document.getElementById('modalSubmit');
  const status = document.getElementById('payment-status-container');
  btn.disabled = true;
  btn.textContent = 'Processing...';
  status.textContent = '';

  try {
    // 1. Tokenize card via Square
    const result = await card.tokenize();
    if (result.status !== 'OK') {
      status.textContent = 'Payment error: ' + result.errors[0].message;
      btn.disabled = false;
      btn.textContent = 'Complete Booking';
      return;
    }

    // 2. Submit booking to Laravel
    const form = document.getElementById('bookingForm');
    const formData = new FormData(form);
    formData.append('square_token', result.token);

    const res = await fetch('{{ route("booking.store") }}', {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
      body: formData,
    });

    const data = await res.json();

    if (data.success) {
      // 3. Redirect to Square checkout to complete payment
      window.location.href = data.checkout_url;
    } else {
      status.textContent = data.message ?? 'Something went wrong.';
      btn.disabled = false;
      btn.textContent = 'Complete Booking';
    }
  } catch (err) {
    status.textContent = 'Unexpected error. Please try again.';
    btn.disabled = false;
    btn.textContent = 'Complete Booking';
  }
});

// Subscribe forms
async function submitSubscribe(formEl, onSuccess) {
  const btn = formEl.querySelector('button[type="submit"]');
  btn.textContent = 'Saving...';
  btn.disabled = true;
  const res = await fetch('{{ route("subscribe") }}', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
    },
    body: JSON.stringify({
      name:  formEl.querySelector('input[name="name"]').value,
      email: formEl.querySelector('input[name="email"]').value,
    }),
  });
  const data = await res.json();
  if (data.success) { onSuccess(); }
  else {
    btn.textContent = 'Try Again';
    btn.disabled = false;
    alert(data.message ?? 'Something went wrong.');
  }
}

const emptyForm = document.getElementById('emptySubscribeForm');
if (emptyForm) {
  emptyForm.addEventListener('submit', (e) => {
    e.preventDefault();
    submitSubscribe(emptyForm, () => {
      emptyForm.querySelectorAll('input').forEach(i => i.style.display = 'none');
      emptyForm.querySelector('button').style.display = 'none';
      emptyForm.querySelector('.subscribe-note').style.display = 'none';
      document.getElementById('emptySuccess').style.display = 'block';
    });
  });
}

const stripForm = document.getElementById('stripForm');
if (stripForm) {
  stripForm.addEventListener('submit', (e) => {
    e.preventDefault();
    submitSubscribe(stripForm, () => {
      stripForm.innerHTML = '<p style="font-family:var(--serif);font-style:italic;font-size:18px;color:var(--taupe);">You\'re on the list. ✦</p>';
    });
  });
}
</script>
@endsection