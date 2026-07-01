<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Mooré Connections')</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">

<style>
:root { --base: #FAF7F2; --blush: #F0E8DC; --taupe: #9C8874; --brown: #6B4F3A; --dark: #2C1A0E; --white: #FFFFFF; --serif: 'Cormorant Garamond', Georgia, serif; --sans: 'DM Sans', sans-serif; }

html {
  scrollbar-width: none; 
  -ms-overflow-style: none;
}
html::-webkit-scrollbar {
  display: none;
}
body {
  overflow-x: hidden;
  max-width: 100vw;
}

.nav-toggle {
  display: none;
  background: none;
  border: none;
  cursor: pointer;
  padding: 8px;
  flex-direction: column;
  gap: 5px;
}
.nav-toggle span {
  width: 22px; height: 1.5px;
  background: var(--dark);
  transition: transform 0.3s, opacity 0.3s;
}
.nav-toggle.open span:nth-child(1) { transform: translateY(6.5px) rotate(45deg); }
.nav-toggle.open span:nth-child(2) { opacity: 0; }
.nav-toggle.open span:nth-child(3) { transform: translateY(-6.5px) rotate(-45deg); }

.nav-links-mobile {
  display: none;
  position: fixed;
  top: 0; right: 0;
  width: 78%;
  max-width: 320px;
  height: 100vh;
  background: var(--base);
  z-index: 300;
  flex-direction: column;
  padding: 100px 36px 40px;
  gap: 28px;
  transform: translateX(100%);
  transition: transform 0.4s ease;
  box-shadow: -10px 0 40px rgba(44,26,14,0.1);
}
.nav-links-mobile.open {
  display: flex;
  transform: translateX(0);
}
.nav-links-mobile a {
  font-family: var(--sans);
  font-size: 14px; font-weight: 400;
  letter-spacing: 2px; text-transform: uppercase;
  color: var(--dark); text-decoration: none;
  padding-bottom: 14px;
  border-bottom: 1px solid rgba(156,136,116,0.15);
}
.nav-overlay {
  display: none;
  position: fixed; inset: 0;
  background: rgba(44,26,14,0.4);
  z-index: 290;
  opacity: 0;
  transition: opacity 0.3s;
}
.nav-overlay.open {
  display: block;
  opacity: 1;
}

img {
  max-width: 100%;
  height: auto;
}

@media (max-width: 960px) {
  .nav-toggle { display: flex; }
  .nav-links { display: none; }

  .hero-flower-main      { width: 60%; max-width: 220px; }
  .hero-flower-accent    { width: 28%; max-width: 110px; }
  .about-flower,
  .about-page-flower     { width: 70%; max-width: 240px; }
  .about-flower-sm,
  .about-page-flower-sm  { width: 26%; max-width: 90px; }
  .why-flower-main       { width: 65%; max-width: 220px; }
  .why-flower-sm         { width: 26%; max-width: 90px; }
  .journal-flower        { width: 60%; max-width: 200px; }
  .journal-flower-sm     { width: 24%; max-width: 80px; }
  .empty-flower-main     { width: 65%; max-width: 220px; }
  .empty-flower-sm       { width: 26%; max-width: 90px; }
  .page-hero-flower      { width: 110px; }
  .quote-flower-l,
  .quote-flower-r        { width: 140px; }
  .event-card-flower     { height: 110px; }
  .journal-hero-flower   { width: 90px; }
  .confirmation-flower   { width: 70px; }
}

@media (max-width: 480px) {
  .hero-flower-main      { max-width: 170px; }
  .about-flower,
  .about-page-flower     { max-width: 190px; }
  .why-flower-main       { max-width: 170px; }
  .journal-flower        { max-width: 160px; }
  .empty-flower-main     { max-width: 170px; }
}


@media (max-width: 960px) {
  .nav-book { display: none; }

  .journal-flower,
  .journal-flower-sm,
  .journal-visual {
    display: none;
  }

  .hero-flower-main,
  .hero-flower-accent,
  .hero-scroll,
  .hero-scroll-line {
    display: none;
  }

  .about-visual
  .about-flower,
  .about-flower-sm {
    display: none;
  }

  .events-empty-flower,
  .events-empty-flower-sm {
    display: none !important;
  }

  .events-empty {
    width: 100%;
    grid-template-columns: 1fr;
    gap: 32px;
  }

  .events-empty-heading, .events-empty-body, .subscribe-form, .subscribe-note, .subscribe-success {
    width: 100%;
    grid-template-columns: 1fr;
    gap: 32px;
  }

  .subscribe-form .form-row {
    align-items: center;
    text-align: center;
    justify-items: center;
  }

  .events-empty-visual {
    display: none;
  }

  .subscribe-form {
    max-width: 100%;
  }

  .why-flower-main, .why-flower-sm {
    display: none;
  }



  #emptyState {
    display: flex;
    flex-direction: column;
  }
}
</style>

@yield('styles')


</head>
<body>

<nav class="nav" id="nav">
  <a href="{{ route('home') }}" class="nav-logo">
    <img src="{{ asset('img/logo-removebg-preview.png') }}" alt="Mooré Connections">
  </a>
  <ul class="nav-links">
    <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a></li>
    <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">About</a></li>
    <li><a href="{{ route('events') }}" class="{{ request()->routeIs('events') ? 'active' : '' }}">Events</a></li>
    <li><a href="{{ route('journal') }}" class="{{ request()->routeIs('journal') ? 'active' : '' }}">Journal</a></li>
  </ul>
  <a href="{{ route('events') }}" class="nav-book">Get Notified</a>
  <button class="nav-toggle" id="navToggle" aria-label="Menu">
    <span></span><span></span><span></span>
  </button>
</nav>

<div class="nav-overlay" id="navOverlay"></div>
<div class="nav-links-mobile" id="navMobile">
  <a href="{{ route('home') }}">Home</a>
  <a href="{{ route('about') }}">About</a>
  <a href="{{ route('events') }}">Events</a>
  <a href="{{ route('journal') }}">Journal</a>
</div>

@yield('content')

<footer>
  <div class="footer-inner">
    <div class="footer-logo">
      <img src="{{ asset('img/logo-removebg-preview.png') }}" alt="Mooré Connections">
    </div>
    <ul class="footer-links">
      <li><a href="{{ route('home') }}">Home</a></li>
      <li><a href="{{ route('about') }}">About</a></li>
      <li><a href="{{ route('events') }}">Events</a></li>
      <li><a href="{{ route('journal') }}">Journal</a></li>
    </ul>
    <p class="footer-copy">© {{ date('Y') }} Mooré Connections</p>
  </div>
</footer>


<script>
const navToggle  = document.getElementById('navToggle');
const navMobile  = document.getElementById('navMobile');
const navOverlay = document.getElementById('navOverlay');

function toggleMobileNav() {
  navToggle.classList.toggle('open');
  navMobile.classList.toggle('open');
  navOverlay.classList.toggle('open');
  document.body.style.overflow = navMobile.classList.contains('open') ? 'hidden' : '';
}

navToggle?.addEventListener('click', toggleMobileNav);
navOverlay?.addEventListener('click', toggleMobileNav);
navMobile?.querySelectorAll('a').forEach(a =>
  a.addEventListener('click', toggleMobileNav)
);
</script>

@yield('scripts')
</body>
</html>