@extends('layouts.app')

@section('title', 'Mooré Connections — Come Home to Yourself')

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

.nav { position: fixed; top: 0; left: 0; right: 0; z-index: 200; display: flex; align-items: center; justify-content: space-between; padding: 22px 56px; transition: background 0.5s, border-color 0.5s; border-bottom: 1px solid transparent; }
.nav.scrolled { background: rgba(250,247,242,0.95); backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px); border-color: rgba(156,136,116,0.18); }
.nav-logo img { height: 46px; width: auto; display: block; }
.nav-links { display: flex; gap: 40px; list-style: none; }
.nav-links a { font-family: var(--sans); font-size: 11px; font-weight: 400; letter-spacing: 2.2px; text-transform: uppercase; color: var(--dark); text-decoration: none; transition: color 0.2s; }
.nav-links a:hover { color: var(--taupe); }
.nav-book { font-family: var(--sans); font-size: 11px; font-weight: 500; letter-spacing: 1.8px; text-transform: uppercase; color: var(--white); background: var(--dark); padding: 12px 30px; text-decoration: none; transition: background 0.25s; border: none; cursor: pointer; }
.nav-book:hover { background: var(--brown); }

.hero { min-height: 100vh; background: var(--base); display: grid; grid-template-columns: 1fr 1fr; align-items: center; padding: 120px 56px 80px; gap: 0; position: relative; overflow: hidden; }
.hero-left { display: flex; flex-direction: column; justify-content: center; padding-right: 60px; z-index: 2; }
.hero-eyebrow { font-family: var(--sans); font-size: 10px; font-weight: 400; letter-spacing: 3.5px; text-transform: uppercase; color: var(--taupe); margin-bottom: 32px; opacity: 0; animation: fadeUp 0.9s 0.2s ease forwards; }
.hero-wordmark { width: 100%; max-width: 300px; display: block; margin-bottom: 36px; opacity: 0; animation: fadeUp 0.9s 0.38s ease forwards; }
.hero-line { width: 48px; height: 1px; background: var(--taupe); margin-bottom: 32px; opacity: 0; animation: fadeUp 0.9s 0.52s ease forwards; }
.hero-tagline { font-family: var(--serif); font-size: clamp(18px, 2vw, 24px); font-weight: 300; font-style: italic; color: var(--brown); line-height: 1.65; margin-bottom: 52px; max-width: 380px; opacity: 0; animation: fadeUp 0.9s 0.64s ease forwards; }
.hero-actions { display: flex; gap: 24px; align-items: center; opacity: 0; animation: fadeUp 0.9s 0.78s ease forwards; }

.btn-dark { font-family: var(--sans); font-size: 11px; font-weight: 500; letter-spacing: 2px; text-transform: uppercase; color: var(--white); background: var(--dark); padding: 15px 40px; text-decoration: none; display: inline-block; transition: background 0.25s, transform 0.2s; }
.btn-dark:hover { background: var(--brown); transform: translateY(-2px); }

.btn-text { font-family: var(--sans); font-size: 11px; font-weight: 400; letter-spacing: 2px; text-transform: uppercase; color: var(--taupe); text-decoration: none; border-bottom: 1px solid currentColor; padding-bottom: 2px; transition: color 0.2s; }
.btn-text:hover { color: var(--dark); }

.hero-right { position: relative; height: 100%; min-height: 500px; display: flex; align-items: center; justify-content: center; }
.hero-flower-main { width: 75%; max-width: 480px; position: relative; z-index: 2; opacity: 0; animation: fadeScale 1.1s 0.5s ease forwards; will-change: transform; }
.hero-flower-accent { position: absolute; bottom: 5%; left: 2%; width: 36%; z-index: 1; opacity: 0; animation: fadeScale 1.1s 0.9s ease forwards; will-change: transform; }
.hero-scroll { position: absolute; bottom: 40px; left: 56px; display: flex; align-items: center; gap: 14px; opacity: 0; animation: fadeUp 1s 1.3s ease forwards; }
.hero-scroll-line { width: 40px; height: 1px; background: var(--taupe); transform-origin: left; animation: lineGrow 1s 1.6s ease forwards; transform: scaleX(0); }
@keyframes lineGrow { to { transform: scaleX(1); } }
.hero-scroll span { font-size: 9px; letter-spacing: 3px; text-transform: uppercase; color: var(--taupe); font-family: var(--sans); }

@keyframes fadeUp { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
@keyframes fadeScale { from { opacity: 0; transform: scale(0.96); } to { opacity: 1; transform: scale(1); } }

.section-pad { padding: 110px 56px; }
.section-pad-sm { padding: 80px 56px; }
.inner { max-width: 1080px; margin: 0 auto; }
.label { font-family: var(--sans); font-size: 9.5px; font-weight: 400; letter-spacing: 3.5px; text-transform: uppercase; color: var(--taupe); margin-bottom: 18px; display: block; }
.heading-lg { font-family: var(--serif); font-size: clamp(32px, 4vw, 52px); font-weight: 400; line-height: 1.15; color: var(--dark); }
.heading-lg em { font-style: italic; color: var(--taupe); }
.heading-md { font-family: var(--serif); font-size: clamp(24px, 3vw, 36px); font-weight: 400; line-height: 1.2; color: var(--dark); }
.body-text { font-family: var(--sans); font-size: 15px; font-weight: 300; line-height: 1.85; color: var(--brown); }
.rule { width: 40px; height: 1px; background: var(--taupe); margin: 24px 0; }

.about { background: var(--white); }
.about-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center; }
.about-visual { position: relative; display: flex; align-items: center; justify-content: flex-end; }
.about-flower { width: 85%; max-width: 400px; display: block; }
.about-flower-sm { position: absolute; top: -20px; left: 0; width: 35%; opacity: 0.75; }
.about-text .body-text { margin-top: 20px; max-width: 440px; }
.about-sig { font-family: var(--serif); font-style: italic; font-size: 20px; color: var(--taupe); margin-top: 32px; display: block; }

.events-preview { background: var(--base); }
.events-preview-header { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 64px; }
.events-preview-header .heading-lg { max-width: 420px; }

.events-empty { display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center; }
.events-empty-visual { position: relative; display: flex; justify-content: center; }
.events-empty-flower { width: 80%; max-width: 360px; }
.events-empty-flower-sm { position: absolute; top: -10px; right: 0; width: 34%; opacity: 0.7; }
.events-empty-heading { font-family: var(--serif); font-size: clamp(26px, 3vw, 38px); font-weight: 400; font-style: italic; color: var(--dark); line-height: 1.25; margin-bottom: 16px; }
.events-empty-body { font-family: var(--sans); font-size: 15px; font-weight: 300; line-height: 1.85; color: var(--brown); margin-bottom: 40px; }
.subscribe-form { display: flex; flex-direction: column; gap: 14px; max-width: 400px; }
.subscribe-form .form-row { display: flex; gap: 12px; }
.subscribe-form input { font-family: var(--sans); font-size: 13px; font-weight: 300; color: var(--dark); background: var(--white); border: 1px solid rgba(156,136,116,0.3); padding: 13px 18px; outline: none; width: 100%; transition: border-color 0.2s; -webkit-appearance: none; }
.subscribe-form input::placeholder { color: rgba(107,79,58,0.45); }
.subscribe-form input:focus { border-color: var(--taupe); }
.subscribe-form button { font-family: var(--sans); font-size: 11px; font-weight: 500; letter-spacing: 2px; text-transform: uppercase; color: var(--white); background: var(--dark); border: none; padding: 14px 32px; cursor: pointer; white-space: nowrap; transition: background 0.25s; }
.subscribe-form button:hover { background: var(--brown); }
.subscribe-note { font-size: 11px; color: var(--taupe); font-family: var(--sans); font-weight: 300; }
.subscribe-success { display: none; font-family: var(--serif); font-style: italic; font-size: 18px; color: var(--taupe); }

.why { background: var(--blush); position: relative; overflow: hidden; }
.why-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center; }
.why-list { list-style: none; margin-top: 36px; }
.why-item { display: flex; gap: 24px; padding: 22px 0; border-bottom: 1px solid rgba(156,136,116,0.22); align-items: flex-start; }
.why-item:first-child { border-top: 1px solid rgba(156,136,116,0.22); }
.why-roman { font-family: var(--serif); font-style: italic; font-size: 24px; color: var(--taupe); min-width: 28px; line-height: 1.2; padding-top: 2px; }
.why-item-title { font-family: var(--sans); font-size: 11px; font-weight: 500; letter-spacing: 1.8px; text-transform: uppercase; color: var(--dark); margin-bottom: 6px; }
.why-item-body { font-family: var(--sans); font-size: 13.5px; font-weight: 300; line-height: 1.7; color: var(--brown); }
.why-visual { position: relative; display: flex; align-items: center; justify-content: center; }
.why-flower-main { width: 85%; max-width: 380px; }
.why-flower-sm { position: absolute; bottom: -20px; right: -10px; width: 38%; opacity: 0.8; }

.journal { background: var(--white); }
.journal-inner { display: grid; grid-template-columns: 1fr 1fr; gap: 80px; align-items: center; }
.journal-visual { position: relative; display: flex; justify-content: center; }
.journal-flower { width: 78%; max-width: 360px; }
.journal-flower-sm { position: absolute; top: -10px; right: -10px; width: 34%; opacity: 0.7; }
.steps-list { list-style: none; margin-top: 36px; }
.step-item { display: grid; grid-template-columns: 44px 1fr; gap: 16px; padding: 22px 0; border-bottom: 1px solid rgba(156,136,116,0.18); align-items: start; }
.step-item:first-child { border-top: 1px solid rgba(156,136,116,0.18); }
.step-num { font-family: var(--serif); font-size: 36px; font-style: italic; color: rgba(156,136,116,0.35); line-height: 1; }
.step-title { font-family: var(--sans); font-size: 11px; font-weight: 500; letter-spacing: 1.6px; text-transform: uppercase; color: var(--dark); margin-bottom: 6px; }
.step-body { font-family: var(--sans); font-size: 13.5px; font-weight: 300; line-height: 1.7; color: var(--brown); }

.quote-banner { background: var(--dark); padding: 110px 56px; text-align: center; position: relative; overflow: hidden; }
.quote-flower-l { position: absolute; left: -40px; top: 50%; transform: translateY(-50%); width: 260px; opacity: 0.1; pointer-events: none; }
.quote-flower-r { position: absolute; right: -40px; top: 50%; transform: translateY(-50%) scaleX(-1); width: 260px; opacity: 0.1; pointer-events: none; }
.quote-inner { position: relative; z-index: 1; max-width: 700px; margin: 0 auto; }
.quote-mark { font-family: var(--serif); font-size: 80px; line-height: 0.6; color: var(--taupe); opacity: 0.4; display: block; margin-bottom: 24px; }
.quote-text { font-family: var(--serif); font-size: clamp(28px, 4vw, 48px); font-weight: 300; font-style: italic; color: var(--base); line-height: 1.3; margin-bottom: 16px; }
.quote-attr { font-family: var(--sans); font-size: 10px; letter-spacing: 3px; text-transform: uppercase; color: var(--taupe); margin-top: 32px; margin-bottom: 52px; display: block; }
.btn-light { font-family: var(--sans); font-size: 11px; font-weight: 500; letter-spacing: 2px; text-transform: uppercase; color: var(--dark); background: var(--base); padding: 15px 44px; text-decoration: none; display: inline-block; transition: background 0.25s, transform 0.2s; }
.btn-light:hover { background: var(--blush); transform: translateY(-2px); }

.testimonials { background: var(--base); padding: 110px 56px; }
.testi-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 28px; margin-top: 56px; }
.testi-card { background: var(--white); padding: 36px 32px; border: 1px solid rgba(156,136,116,0.1); }
.testi-stars { color: var(--taupe); font-size: 14px; letter-spacing: 2px; margin-bottom: 18px; }
.testi-body { font-family: var(--serif); font-size: 17px; font-weight: 300; font-style: italic; color: var(--dark); line-height: 1.65; margin-bottom: 24px; }
.testi-name { font-family: var(--sans); font-size: 10px; font-weight: 500; letter-spacing: 2px; text-transform: uppercase; color: var(--taupe); }

footer { background: var(--white); border-top: 1px solid rgba(156,136,116,0.15); padding: 60px 56px 40px; }
.footer-inner { max-width: 1080px; margin: 0 auto; display: grid; grid-template-columns: auto 1fr auto; gap: 48px; align-items: center; }
.footer-logo img { height: 44px; }
.footer-links { display: flex; justify-content: center; gap: 36px; list-style: none; }
.footer-links a { font-size: 10px; letter-spacing: 2px; text-transform: uppercase; color: var(--brown); text-decoration: none; font-family: var(--sans); transition: color 0.2s; }
.footer-links a:hover { color: var(--dark); }
.footer-copy { font-size: 11px; color: var(--taupe); font-family: var(--sans); font-weight: 300; text-align: right; }

@media (max-width: 960px) { .nav { padding: 18px 24px; } .nav-links { display: none; } .hero { grid-template-columns: 1fr; padding: 100px 24px 60px; text-align: center; } .hero-left { padding-right: 0; align-items: center; } .hero-wordmark { max-width: 300px; } .hero-tagline { max-width: 100%; } .hero-actions { justify-content: center; flex-wrap: wrap; } .hero-right { min-height: 320px; } .hero-scroll { left: 24px; } .about-grid, .why-grid, .journal-inner { grid-template-columns: 1fr; gap: 40px; } .events-empty { grid-template-columns: 1fr; gap: 32px; } .events-empty-visual { display: none; } .section-pad { padding: 72px 24px; } .section-pad-sm { padding: 56px 24px; } .offerings-header { flex-direction: column; align-items: flex-start; gap: 24px; } .offerings-grid { grid-template-columns: 1fr 1fr; gap: 16px; } .testi-grid { grid-template-columns: 1fr; } .quote-banner { padding: 80px 24px; } .footer-inner { grid-template-columns: 1fr; text-align: center; gap: 24px; } .footer-links { justify-content: center; } .footer-copy { text-align: center; } }
@media (prefers-reduced-motion: reduce) { .reveal, .hero-flower-main, .hero-flower-accent { transition: none; animation: none; opacity: 1; transform: none; } }
</style>

@endsection



@section('content')

<section class="hero" id="home">
  <div class="hero-left">
    <span class="hero-eyebrow">Welcome</span>
    <img
      class="hero-wordmark"
      src="{{ asset('img/hero.png') }}"
      alt="Mooré Connections">
    <div class="hero-line"></div>
    <p class="hero-tagline">
      A space to slow down, reconnect,<br>and return to yourself.
    </p>
    <div class="hero-actions">
      <a href="#offerings" class="btn-dark">Explore Sessions</a>
      <a href="#about" class="btn-text">Meet Madison</a>
    </div>
  </div>

  <div class="hero-right">
    <img
      id="heroFlowerMain"
      class="hero-flower-main"
      src="{{ asset('img/IMG_3864-removebg-preview.png') }}"
      alt="">
    <img
      id="heroFlowerAccent"
      class="hero-flower-accent"
      src="{{ asset('img/IMG_3869-removebg-preview.png') }}"
      alt="">
  </div>

  <div class="hero-scroll">
    <div class="hero-scroll-line"></div>
    <span>Scroll</span>
  </div>
</section>

<section class="about section-pad" id="about">
  <div class="inner about-grid">
    <div class="about-visual reveal">
      <img class="about-flower"
           src="{{ asset('img/IMG_3868-removebg-preview.png') }}" alt="">
      <img class="about-flower-sm"
           src="{{ asset('img/IMG_3867-removebg-preview.png') }}" alt="">
    </div>
    <div class="about-text">
      <span class="label reveal reveal-delay-1">Hi, I'm Your Guide</span>
      <h2 class="heading-lg reveal reveal-delay-2">
        True wellness starts<br>with <em>connection.</em>
      </h2>
      <div class="rule reveal reveal-delay-3"></div>
      <p class="body-text reveal reveal-delay-3">
        I created this community because I believe that real clarity, presence,
        and joy come from being deeply connected — to ourselves, to others, and
        to the life we are actively creating together.
      </p>
      <p class="body-text reveal reveal-delay-4" style="margin-top:16px;">
        This is a space for you to slow down, reflect, and reconnect with what
        truly matters. Whether through a private session, a group event, or a
        daily journaling practice — every experience here is designed to bring
        you home to yourself.
      </p>
      <span class="about-sig reveal reveal-delay-4">With love, Madison xo</span>
    </div>
  </div>
</section>

<section class="events-preview section-pad" id="offerings">
  <div class="inner">
    <div class="events-preview-header">
      <div>
        <span class="label reveal">Upcoming Events</span>
        <h2 class="heading-lg reveal reveal-delay-1">
          Gather, reflect,<br><em>and reconnect.</em>
        </h2>
      </div>
      <a href="{{ route('events') }}" class="btn-text reveal reveal-delay-2">View all events →</a>
    </div>

    <div class="events-empty">
      <div class="events-empty-visual reveal">
        <img class="events-empty-flower"
             src="{{ asset('img/IMG_3864-removebg-preview.png') }}" alt="">
        <img class="events-empty-flower-sm"
             src="{{ asset('img/IMG_3867-removebg-preview.png') }}" alt="">
      </div>
      <div>
        <p class="events-empty-heading reveal reveal-delay-1">
          Something beautiful<br>is being planned.
        </p>
        <p class="events-empty-body reveal reveal-delay-2">
          No events are scheduled just yet, but they're coming.
          Leave your name and email below and you'll be the very first
          to know when Madison announces something new.
        </p>
        <form class="subscribe-form reveal reveal-delay-3" id="subscribeForm">
          <div class="form-row">
            <input type="text" name="name" placeholder="Your first name" required>
            <input type="email" name="email" placeholder="Your email" required>
          </div>
          <div class="form-row">
            <button type="submit">Notify Me</button>
          </div>
          <p class="subscribe-note">No spam, ever. Just a quiet note when something's ready.</p>
          <p class="subscribe-success" id="subscribeSuccess">
            You're on the list! We'll be in touch.
          </p>
        </form>
      </div>
    </div>
  </div>
</section>

<section class="why section-pad" id="community">
  <div class="inner why-grid">
    <div>
      <span class="label reveal">Why Connection?</span>
      <h2 class="heading-lg reveal reveal-delay-1">
        The power of<br><em>showing up.</em>
      </h2>
      <ul class="why-list">
        <li class="why-item reveal reveal-delay-1">
          <span class="why-roman">i.</span>
          <div>
            <p class="why-item-title">Connect With Yourself</p>
            <p class="why-item-body">Tune in to your thoughts, emotions, and inner world — without judgment.</p>
          </div>
        </li>
        <li class="why-item reveal reveal-delay-2">
          <span class="why-roman">ii.</span>
          <div>
            <p class="why-item-title">Clarify What Matters</p>
            <p class="why-item-body">Get clear on your values, desires, and what truly lights you up.</p>
          </div>
        </li>
        <li class="why-item reveal reveal-delay-3">
          <span class="why-roman">iii.</span>
          <div>
            <p class="why-item-title">Build Stronger Relationships</p>
            <p class="why-item-body">When we understand ourselves, we connect more deeply with everyone around us.</p>
          </div>
        </li>
        <li class="why-item reveal reveal-delay-4">
          <span class="why-roman">iv.</span>
          <div>
            <p class="why-item-title">Create a Life You Love</p>
            <p class="why-item-body">Small daily moments of reflection lead to the big shifts you've been waiting for.</p>
          </div>
        </li>
      </ul>
    </div>
    <div class="why-visual reveal">
      <img class="why-flower-main"
           src="{{ asset('img/IMG_3864-removebg-preview.png') }}" alt="">
      <img class="why-flower-sm"
           src="{{ asset('img/IMG_3863-removebg-preview.png') }}" alt="">
    </div>
  </div>
</section>

<section class="journal section-pad" id="journal">
  <div class="inner journal-inner">
    <div>
      <span class="label reveal">Your Daily Practice</span>
      <h2 class="heading-lg reveal reveal-delay-1">
        A simple 3-step<br><em>framework.</em>
      </h2>
      <div class="rule reveal reveal-delay-2"></div>
      <p class="body-text reveal reveal-delay-2">
        Five minutes each day. Three honest questions. No pressure, no perfection —
        just you, showing up for yourself.
      </p>
      <ul class="steps-list" style="margin-top:36px;">
        <li class="step-item reveal reveal-delay-2">
          <span class="step-num">1</span>
          <div>
            <p class="step-title">How do I feel today?</p>
            <p class="step-body">Check in with your emotions. Name it without judgment.</p>
          </div>
        </li>
        <li class="step-item reveal reveal-delay-3">
          <span class="step-num">2</span>
          <div>
            <p class="step-title">What do I want this day to bring?</p>
            <p class="step-body">Set an intention. What would make today feel meaningful?</p>
          </div>
        </li>
        <li class="step-item reveal reveal-delay-4">
          <span class="step-num">3</span>
          <div>
            <p class="step-title">Three things I'm grateful for.</p>
            <p class="step-body">Gratitude shifts everything. Big or small — name them.</p>
          </div>
        </li>
      </ul>
      <div style="margin-top:44px;" class="reveal reveal-delay-4">
        <a href="#book" class="btn-dark">Start Your Practice</a>
      </div>
    </div>
    <div class="journal-visual reveal">
      <img class="journal-flower"
           src="{{ asset('img/IMG_3865-removebg-preview.png') }}" alt="">
      <img class="journal-flower-sm"
           src="{{ asset('img/IMG_3867-removebg-preview.png') }}" alt="">
    </div>
  </div>
</section>

<section class="quote-banner" id="book">
  <img class="quote-flower-l"
       src="{{ asset('img/IMG_3864-removebg-preview.png') }}" alt="">
  <img class="quote-flower-r"
       src="{{ asset('img/IMG_3864-removebg-preview.png') }}" alt="">
  <div class="quote-inner">
    <span class="quote-mark reveal">"</span>
    <p class="quote-text reveal reveal-delay-1">
      Connection is the new wellness.
    </p>
    <span class="quote-attr reveal reveal-delay-2">Mooré Connections</span>
    <div class="reveal reveal-delay-3">
      <a href="{{ route('events') }}" class="btn-light">Book Your Session</a>
    </div>
  </div>
</section>

<section class="testimonials">
  <div class="inner">
    <span class="label reveal">Kind Words</span>
    <h2 class="heading-md reveal reveal-delay-1">What our community says</h2>
    <div class="testi-grid">
      <div class="testi-card reveal reveal-delay-1">
        <p class="testi-stars">★★★★★</p>
        <p class="testi-body">"This practice genuinely changed how I start my mornings. I feel more grounded than I have in years."</p>
        <p class="testi-name">— Sarah M., Sydney</p>
      </div>
      <div class="testi-card reveal reveal-delay-2">
        <p class="testi-stars">★★★★★</p>
        <p class="testi-body">"Madison holds such a safe, beautiful space. I leave every session feeling lighter and clearer."</p>
        <p class="testi-name">— Emma R., Melbourne</p>
      </div>
      <div class="testi-card reveal reveal-delay-3">
        <p class="testi-stars">★★★★★</p>
        <p class="testi-body">"The Inner Circle community is unlike anything I've found online. Genuine, warm, and deeply nourishing."</p>
        <p class="testi-name">— Jess T., Brisbane</p>
      </div>
    </div>
  </div>
</section>

@endsection




@section('scripts')
<script>
// Nav scroll
const nav = document.getElementById('nav');
window.addEventListener('scroll', () => {
  nav.classList.toggle('scrolled', window.scrollY > 50);
}, { passive: true });

// Intersection Observer — reveal on scroll
const revealEls = document.querySelectorAll('.reveal');
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('visible');
      observer.unobserve(entry.target);
    }
  });
}, { threshold: 0.12 });
revealEls.forEach(el => observer.observe(el));

// Parallax — hero flowers drift gently on scroll
const heroMain   = document.getElementById('heroFlowerMain');
const heroAccent = document.getElementById('heroFlowerAccent');

window.addEventListener('scroll', () => {
  const y = window.scrollY;
  if (heroMain)   heroMain.style.transform   = `translateY(${y * 0.18}px)`;
  if (heroAccent) heroAccent.style.transform = `translateY(${y * 0.1}px)`;
}, { passive: true });

// Subscribe form — demo handler (replace with fetch to /subscribe in Laravel)
const subscribeForm = document.getElementById('subscribeForm');
const subscribeSuccess = document.getElementById('subscribeSuccess');
if (subscribeForm) {
  subscribeForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const btn = subscribeForm.querySelector('button');
    btn.textContent = 'Saving...';
    btn.disabled = true;
    // In Laravel this becomes: fetch('/subscribe', { method:'POST', body: new FormData(subscribeForm) })
    setTimeout(() => {
      subscribeForm.querySelector('.form-row:first-child').style.display = 'none';
      subscribeForm.querySelector('.form-row:last-of-type').style.display = 'none';
      subscribeForm.querySelector('.subscribe-note').style.display = 'none';
      subscribeSuccess.style.display = 'block';
    }, 800);
  });
}


function setupSubscribeForm(formId, successId) {
  const form = document.getElementById(formId);
  if (!form) return;
  form.addEventListener('submit', async (e) => {
    e.preventDefault();
    const btn = form.querySelector('button');
    btn.textContent = 'Saving...';
    btn.disabled = true;

    const res = await fetch('{{ route("subscribe") }}', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      },
      body: JSON.stringify({
        name:  form.querySelector('input[name="name"]').value,
        email: form.querySelector('input[name="email"]').value,
      }),
    });

    const data = await res.json();

    if (data.success) {
      form.querySelector('.form-row:first-child').style.display = 'none';
      form.querySelector('.form-row:last-of-type').style.display = 'none';
      form.querySelector('.subscribe-note').style.display = 'none';
      document.getElementById(successId).style.display = 'block';
    } else {

    btn.textContent = 'Try Again';
      btn.disabled = false;
      alert(data.message ?? 'Something went wrong.');
    }
  });
}
setupSubscribeForm('subscribeForm', 'subscribeSuccess');
</script>
@endsection