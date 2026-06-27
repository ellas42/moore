<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Mooré Connections')</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300;1,400;1,500&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
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
</nav>

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

@yield('scripts')
</body>
</html>