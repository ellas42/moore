@extends('layouts.app')

@section('title', 'About Mooré Connections')

@section('styles')
<style>
:root { --base: #FAF7F2; --blush: #F0E8DC; --taupe: #9C8874; --brown: #6B4F3A; --dark: #2C1A0E; --white: #FFFFFF; --serif: 'Cormorant Garamond', Georgia, serif; --sans: 'DM Sans', sans-serif; }
*, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
html { scroll-behavior: smooth; }
body { font-family: var(--sans); background: var(--base); color: var(--dark); overflow-x: hidden; }
.reveal { opacity: 0; transform: translateY(28px); transition: opacity 0.8s ease, transform 0.8s ease; }
.reveal.visible { opacity: 1; transform: translateY(0); }
.reveal-delay-1 { transition-delay: 0.1s; }
.reveal-delay-2 { transition-delay: 0.22s; }
.reveal-delay-3 { transition-delay: 0.34s; }
.reveal-delay-4 { transition-delay: 0.46s; }
.about-page { padding: 140px 56px 100px; max-width: 1080px; margin: 0 auto; }
.about-page-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center; }
.about-visual { position: relative; display: flex; align-items: center; justify-content: center; }
.about-page-flower { width: 85%; max-width: 420px; display: block; }
.about-page-flower-sm { position: absolute; top: -20px; left: -10px; width: 34%; opacity: 0.7; }
.label { font-family: var(--sans); font-size: 9.5px; font-weight: 400; letter-spacing: 3.5px; text-transform: uppercase; color: var(--taupe); margin-bottom: 18px; display: block; }
.heading-lg { font-family: var(--serif); font-size: clamp(32px, 4vw, 52px); font-weight: 400; line-height: 1.15; color: var(--dark); }
.heading-lg em { font-style: italic; color: var(--taupe); }
.rule { width: 40px; height: 1px; background: var(--taupe); margin: 24px 0; }
.body-text { font-family: var(--sans); font-size: 15px; font-weight: 300; line-height: 1.85; color: var(--brown); }
.btn-dark { font-family: var(--sans); font-size: 11px; font-weight: 500; letter-spacing: 2px; text-transform: uppercase; color: var(--white); background: var(--dark); padding: 15px 40px; text-decoration: none; display: inline-block; transition: background 0.25s, transform 0.2s; }
.btn-dark:hover { background: var(--brown); transform: translateY(-2px); }
.about-sig { font-family: var(--serif); font-style: italic; font-size: 20px; color: var(--taupe); display: block; margin-top: 32px; }
@media (max-width: 900px) { .about-page { padding: 120px 24px 60px; } .about-page-grid { grid-template-columns: 1fr; gap: 40px; } }
@media (prefers-reduced-motion: reduce) { .reveal { transition: none; animation: none; opacity: 1; transform: none; } }
</style>
@endsection

@section('content')
<div class="about-page">
  <div class="about-page-grid">
    <div class="about-visual reveal">
      <img class="about-page-flower"
           src="{{ asset('img/IMG_3868-removebg-preview.png') }}" alt="">
      <img class="about-page-flower-sm"
           src="{{ asset('img/IMG_3867-removebg-preview.png') }}" alt="">
    </div>
    <div>
      <span class="label reveal">About Madison</span>
      <h1 class="heading-lg reveal reveal-delay-1">
        Hi, I'm your<br><em>guide.</em>
      </h1>
      <div class="rule reveal reveal-delay-2"></div>
      <p class="body-text reveal reveal-delay-2">
        I created Mooré Connections because I believe that true wellness starts
        with connection — to ourselves, to others, and to the life we are
        actively creating together.
      </p>
      <p class="body-text reveal reveal-delay-3" style="margin-top:16px;">
        This daily practice is the foundation for more presence, clarity,
        and meaningful connections in your life. I hope this becomes a space
        for you to slow down, reflect, and reconnect.
      </p>
      <p class="body-text reveal reveal-delay-3" style="margin-top:16px;">
        Whether you join us for a single session, a group event, or simply
        follow along with the daily journaling practice — you are welcome here.
      </p>
      <span class="about-sig reveal reveal-delay-4"
            style="font-family:var(--serif);font-style:italic;font-size:20px;color:var(--taupe);display:block;margin-top:32px;">
        With love, Madison xo
      </span>
      <div style="margin-top:40px;" class="reveal reveal-delay-4">
        <a href="{{ route('events') }}" class="btn-dark">View Upcoming Events</a>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script>
const observer = new IntersectionObserver((entries) => {
  entries.forEach(e => {
    if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); }
  });
}, { threshold: 0.1 });
document.querySelectorAll('.reveal').forEach(el => observer.observe(el));
</script>
@endsection