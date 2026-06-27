@extends('layouts.app')

@section('title', 'Journal — Mooré Connections')

@section('styles')
<style>
.journal-page { padding: 140px 56px 100px; max-width: 860px; margin: 0 auto; text-align: center; }
.journal-hero-flower {
  width: 140px; margin: 0 auto 36px; display: block;
}
.prompts-grid {
  display: grid; grid-template-columns: repeat(3, 1fr);
  gap: 24px; margin-top: 56px; text-align: left;
}
.prompt-card {
  background: var(--white); padding: 36px 28px;
  border: 1px solid rgba(156,136,116,0.12);
}
.prompt-num {
  font-family: var(--serif); font-size: 44px; font-style: italic;
  color: rgba(156,136,116,0.3); line-height: 1; margin-bottom: 16px;
  display: block;
}
.prompt-title {
  font-family: var(--sans); font-size: 11px; font-weight: 500;
  letter-spacing: 1.8px; text-transform: uppercase;
  color: var(--dark); margin-bottom: 10px;
}
.prompt-body {
  font-family: var(--sans); font-size: 13.5px; font-weight: 300;
  line-height: 1.75; color: var(--brown);
}
.tips-section {
  margin-top: 80px; text-align: left;
  background: var(--blush); padding: 56px;
}
.tips-grid {
  display: grid; grid-template-columns: 1fr 1fr;
  gap: 28px; margin-top: 32px;
}
.tip-item { display: flex; gap: 16px; }
.tip-icon {
  font-family: var(--serif); font-size: 22px; font-style: italic;
  color: var(--taupe); min-width: 28px; line-height: 1.3;
}
.tip-title {
  font-family: var(--sans); font-size: 11px; font-weight: 500;
  letter-spacing: 1.5px; text-transform: uppercase;
  color: var(--dark); margin-bottom: 6px;
}
.tip-body {
  font-family: var(--sans); font-size: 13px; font-weight: 300;
  line-height: 1.7; color: var(--brown);
}
@media (max-width: 900px) {
  .journal-page { padding: 120px 24px 60px; }
  .prompts-grid { grid-template-columns: 1fr; }
  .tips-grid { grid-template-columns: 1fr; }
  .tips-section { padding: 36px 24px; }
}
</style>
@endsection

@section('content')
<div class="journal-page">
  <img class="journal-hero-flower reveal"
       src="{{ asset('img/IMG_3865-removebg-preview.png') }}" alt="">
  <span class="label reveal">The Daily Connection</span>
  <h1 class="heading-lg reveal reveal-delay-1">
    A 5-minute practice to feel<br>more <em>like yourself.</em>
  </h1>
  <div class="rule reveal reveal-delay-2" style="margin: 24px auto;"></div>
  <p class="body-text reveal reveal-delay-2" style="max-width:520px;margin:0 auto;">
    Each day, three simple prompts. No pressure, no perfection —
    just you, showing up for yourself. Take five minutes. That's all it takes.
  </p>

  <div class="prompts-grid">
    <div class="prompt-card reveal">
      <span class="prompt-num">1</span>
      <p class="prompt-title">How do I feel today?</p>
      <p class="prompt-body">Check in with your emotions. What are you feeling right now? Name it without judgment. There is no wrong answer.</p>
    </div>
    <div class="prompt-card reveal reveal-delay-1">
      <span class="prompt-num">2</span>
      <p class="prompt-title">What do I want this day to bring?</p>
      <p class="prompt-body">Set an intention. What would make today feel meaningful and aligned with who you want to be?</p>
    </div>
    <div class="prompt-card reveal reveal-delay-2">
      <span class="prompt-num">3</span>
      <p class="prompt-title">Three things I'm grateful for.</p>
      <p class="prompt-body">Gratitude shifts your focus. What are three things — big or small — that you appreciate today?</p>
    </div>
  </div>

  <div class="tips-section reveal">
    <span class="label">Tips for Journaling</span>
    <h2 class="heading-md">Make it a ritual.</h2>
    <div class="tips-grid">
      <div class="tip-item">
        <span class="tip-icon">i.</span>
        <div>
          <p class="tip-title">Keep It Simple</p>
          <p class="tip-body">There is no right or wrong way to journal. Show up as you are.</p>
        </div>
      </div>
      <div class="tip-item">
        <span class="tip-icon">ii.</span>
        <div>
          <p class="tip-title">Make It a Ritual</p>
          <p class="tip-body">Pair it with a habit you already have — morning coffee or bedtime.</p>
        </div>
      </div>
      <div class="tip-item">
        <span class="tip-icon">iii.</span>
        <div>
          <p class="tip-title">Be Honest</p>
          <p class="tip-body">Write what's real for you. This is your safe space.</p>
        </div>
      </div>
      <div class="tip-item">
        <span class="tip-icon">iv.</span>
        <div>
          <p class="tip-title">Short Is Powerful</p>
          <p class="tip-body">Even a few sentences a day can create powerful change over time.</p>
        </div>
      </div>
      <div class="tip-item">
        <span class="tip-icon">v.</span>
        <div>
          <p class="tip-title">Come Back to It</p>
          <p class="tip-body">Revisit your entries and notice how much you grow.</p>
        </div>
      </div>
    </div>
  </div>

  <div style="margin-top:64px;" class="reveal">
    <a href="{{ route('events') }}" class="btn-dark">Join a Live Session</a>
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