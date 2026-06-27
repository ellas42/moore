@extends('layouts.app')

@section('title', 'About — Mooré Connections')

@section('styles')
<style>
.about-page { padding: 140px 56px 100px; max-width: 1080px; margin: 0 auto; }
.about-page-grid {
  display: grid; grid-template-columns: 1fr 1fr;
  gap: 80px; align-items: center;
}
.about-page-flower { width: 85%; max-width: 420px; }
.about-page-flower-sm {
  position: absolute; top: -20px; left: -10px;
  width: 34%; opacity: 0.7;
}
.about-visual { position: relative; display: flex; justify-content: center; }
@media (max-width: 900px) {
  .about-page { padding: 120px 24px 60px; }
  .about-page-grid { grid-template-columns: 1fr; gap: 40px; }
}
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