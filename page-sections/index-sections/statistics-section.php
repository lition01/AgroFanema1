<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title>GreenGrow — Statistics Section</title>
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,600&family=Outfit:wght@300;400;500;600&display=swap" rel="stylesheet" />
<style>
* { box-sizing: border-box; margin: 0; padding: 0; }

.gg-stats {
  --green-deep:  #0D2117;
  --green-mid:   #1E4D30;
  --green-vivid: #2E7D4F;
  --green-bright:#3DAA68;
  --gold:        #C8A84B;
  --gold-light:  #E2C472;
  --bg:          #F5F2EA;
  --text-mid:    #3A3A36;
  --text-muted:  #6B6B62;
  --border:      #E0DDD6;
  --ease:        cubic-bezier(0.4,0,0.2,1);
  --ease-out:    cubic-bezier(0.0,0,0.2,1);
  --h-pad:       80px;
  font-family: 'Outfit', sans-serif;
  background: var(--bg);
  position: relative;
  overflow: hidden;
  width: 100%;
}

.gg-stats::before {
  content: '';
  position: absolute; inset: 0;
  background:
    radial-gradient(ellipse 65% 80% at 0% 50%, rgba(46,125,79,.05) 0%, transparent 60%),
    radial-gradient(ellipse 55% 70% at 100% 50%, rgba(200,168,75,.04) 0%, transparent 60%);
  pointer-events: none;
  z-index: 0;
}

.gg-stats::after {
  content: '';
  position: absolute;
  top: 0; left: 0; right: 0;
  height: 2px;
  background: linear-gradient(90deg, transparent 0%, var(--green-vivid) 20%, var(--gold) 50%, var(--green-bright) 80%, transparent 100%);
  opacity: 0.5;
  z-index: 1;
}

.st-inner {
  position: relative; z-index: 1;
  max-width: 1280px;
  margin: 0 auto;
  padding: clamp(72px, 9vw, 112px) var(--h-pad);
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: clamp(56px, 7vw, 84px);
}

.st-header {
  display: flex; flex-direction: column; align-items: center;
  text-align: center;
  opacity: 0; transform: translateY(20px);
  transition: opacity .7s var(--ease-out) .1s, transform .7s var(--ease-out) .1s;
}
.gg-stats.visible .st-header { opacity: 1; transform: none; }

.st-eyebrow {
  display: inline-flex; align-items: center; gap: 12px;
  margin-bottom: 18px;
}
.st-eyebrow-line { display: block; width: 32px; height: 1.5px; background: var(--gold); }
.st-eyebrow-text {
  font-size: .72rem; font-weight: 600;
  letter-spacing: .22em; text-transform: uppercase;
  color: var(--gold);
}

.st-headline {
  font-family: 'Cormorant Garamond', Georgia, serif;
  font-size: clamp(2rem, 4vw, 3.4rem);
  font-weight: 700; line-height: 1.08;
  letter-spacing: -.01em;
  color: var(--green-deep);
  margin-bottom: 14px;
}
.st-headline em { font-style: italic; color: var(--green-vivid); }

.st-subline {
  font-size: clamp(.88rem, 1.3vw, 1rem);
  font-weight: 300; line-height: 1.7;
  color: var(--text-muted); max-width: 500px;
}

.st-row {
  width: 100%;
  display: flex; align-items: stretch;
}

.st-item {
  flex: 1;
  display: flex; flex-direction: column; align-items: center; text-align: center;
  padding: 0 clamp(20px, 3.5vw, 48px);
  opacity: 0; transform: translateY(24px);
  transition: opacity .7s var(--ease-out), transform .7s var(--ease-out);
}
.gg-stats.visible .st-item { opacity: 1; transform: none; }
.st-item + .st-item { border-left: 1px solid var(--border); }
.st-item:first-child { padding-left: 0; }
.st-item:last-child  { padding-right: 0; }

.st-item:hover .st-number { color: var(--green-mid); transition: color .25s; }
.st-item:hover .st-suffix { color: var(--gold-light); transition: color .25s; }

.st-icon {
  width: 40px; height: 40px;
  display: flex; align-items: center; justify-content: center;
  margin-bottom: 18px;
}
.st-icon svg {
  width: 28px; height: 28px;
  stroke: var(--green-vivid); stroke-width: 1.5; fill: none;
  stroke-linecap: round; stroke-linejoin: round; opacity: .75;
}

.st-num-wrap {
  display: flex; align-items: baseline; gap: 2px;
  margin-bottom: 10px; line-height: 1;
}
.st-number {
  font-family: 'Cormorant Garamond', Georgia, serif;
  font-size: clamp(3rem, 6vw, 5.2rem);
  font-weight: 700; color: var(--green-deep);
  letter-spacing: -.025em; line-height: 1;
  font-variant-numeric: tabular-nums;
}
.st-suffix {
  font-family: 'Cormorant Garamond', Georgia, serif;
  font-size: clamp(1.6rem, 3vw, 2.8rem);
  font-weight: 600; color: var(--gold); line-height: 1;
}

.st-label {
  font-size: .78rem; font-weight: 500;
  letter-spacing: .1em; text-transform: uppercase;
  color: var(--text-muted); line-height: 1.4; margin-bottom: 10px;
}
.st-desc {
  font-size: .78rem; font-weight: 300; line-height: 1.6;
  color: rgba(107,107,98,.65); max-width: 180px;
}

.st-trust-bar {
  width: 100%;
  display: flex; align-items: center; justify-content: center;
  gap: clamp(20px, 4vw, 52px);
  padding: 26px 0;
  border-top: 1px solid var(--border);
  flex-wrap: wrap;
  opacity: 0; transform: translateY(14px);
  transition: opacity .7s var(--ease-out) .9s, transform .7s var(--ease-out) .9s;
}
.gg-stats.visible .st-trust-bar { opacity: 1; transform: none; }

.st-trust-item {
  display: flex; align-items: center; gap: 9px;
  color: var(--text-muted);
  font-size: .74rem; font-weight: 500;
  letter-spacing: .07em; text-transform: uppercase; white-space: nowrap;
}
.st-trust-item svg {
  width: 14px; height: 14px;
  stroke: var(--gold); stroke-width: 2; fill: none; flex-shrink: 0;
}
.st-trust-dot { width: 3px; height: 3px; border-radius: 50%; background: var(--border); }

.st-strip {
  width: 100%; height: 3px;
  background: linear-gradient(90deg, var(--green-deep) 0%, var(--green-vivid) 30%, var(--gold) 55%, var(--green-bright) 78%, transparent 100%);
  opacity: .45;
}

@media (max-width: 1100px) {
  .gg-stats { --h-pad: 52px; }
  .st-number { font-size: clamp(2.6rem, 5vw, 4.2rem); }
}
@media (max-width: 860px) {
  .gg-stats { --h-pad: 36px; }
  .st-row { display: grid; grid-template-columns: 1fr 1fr; gap: 0; }
  .st-item { padding: clamp(28px,5vw,40px) clamp(16px,3vw,32px); border-left: none !important; }
  .st-item:nth-child(2), .st-item:nth-child(4) { border-left: 1px solid var(--border) !important; }
  .st-item:nth-child(3), .st-item:nth-child(4) { border-top: 1px solid var(--border); }
  .st-item:first-child { padding-left: clamp(16px,3vw,32px); }
  .st-item:last-child  { padding-right: clamp(16px,3vw,32px); }
}
@media (max-width: 560px) {
  .gg-stats { --h-pad: 22px; }
  .st-trust-dot { display: none; }
  .st-number { font-size: clamp(2.4rem, 9vw, 3.4rem); }
  .st-suffix { font-size: clamp(1.3rem, 5vw, 2rem); }
}
@media (max-width: 380px) {
  .gg-stats { --h-pad: 16px; }
  .st-row { grid-template-columns: 1fr; }
  .st-item { padding: 24px 0 !important; border-left: none !important; border-top: 1px solid var(--border) !important; }
  .st-item:first-child { border-top: none !important; }
}
</style>
</head>
<body>
<section class="gg-stats" id="gg-stats" aria-label="Company Statistics">
  <div class="st-inner">

    <header class="st-header">
      <div class="st-eyebrow">
        <span class="st-eyebrow-line"></span>
        <span class="st-eyebrow-text">By The Numbers</span>
        <span class="st-eyebrow-line"></span>
      </div>
      <h2 class="st-headline">Two Decades of <em>Proven</em> Results</h2>
      <p class="st-subline">From our first hectare treated to half a million across four continents — every number represents a farmer's livelihood improved.</p>
    </header>

    <div class="st-row">

      <div class="st-item" style="transition-delay:.15s">
        <div class="st-icon">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><polyline points="12 7 12 12 15.5 14"/></svg>
        </div>
        <div class="st-num-wrap">
          <span class="st-number" data-target="25">0</span>
          <span class="st-suffix">+</span>
        </div>
        <div class="st-label">Years Experience</div>
        <p class="st-desc">Serving agriculture since 1999 with continuous R&amp;D.</p>
      </div>

      <div class="st-item" style="transition-delay:.28s">
        <div class="st-icon">
          <svg viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
        </div>
        <div class="st-num-wrap">
          <span class="st-number" data-target="6000">0</span>
          <span class="st-suffix">+</span>
        </div>
        <div class="st-label">Happy Farmers</div>
        <p class="st-desc">Trusted by farms across 40+ countries worldwide.</p>
      </div>

      <div class="st-item" style="transition-delay:.41s">
        <div class="st-icon">
          <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5z"/><path d="M2 17l10 5 10-5"/><path d="M2 12l10 5 10-5"/></svg>
        </div>
        <div class="st-num-wrap">
          <span class="st-number" data-target="150">0</span>
          <span class="st-suffix">+</span>
        </div>
        <div class="st-label">Products</div>
        <p class="st-desc">From granular NPK to chelated micro-nutrient blends.</p>
      </div>

      <div class="st-item" style="transition-delay:.54s">
        <div class="st-icon">
          <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
        </div>
        <div class="st-num-wrap">
          <span class="st-number" data-target="40">0</span>
          <span class="st-suffix">+</span>
        </div>
        <div class="st-label">Distribution Areas</div>
        <p class="st-desc">Active network across Europe, Asia, Africa &amp; Americas.</p>
      </div>

    </div>

    <div class="st-trust-bar">
      <div class="st-trust-item">
        <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><polyline points="9 12 11 14 15 10"/></svg>
        ISO 9001 Certified
      </div>
      <span class="st-trust-dot"></span>
      <div class="st-trust-item">
        <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="6"/><path d="M15.477 12.89L17 22l-5-3-5 3 1.523-9.11"/></svg>
        Industry Award 2023
      </div>
      <span class="st-trust-dot"></span>
      <div class="st-trust-item">
        <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22c4-4 8-8 8-13A8 8 0 0 0 4 9c0 5 4 9 8 13z"/></svg>
        Eco-Safe Formula
      </div>
      <span class="st-trust-dot"></span>
      <div class="st-trust-item">
        <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"/></svg>
        Trusted Since 1999
      </div>
    </div>

  </div>
  <div class="st-strip"></div>
</section>

<script>
(function () {
  var section = document.getElementById('gg-stats');
  var started = false;

  function runCounter(el) {
    var target   = parseInt(el.dataset.target, 10);
    var duration = target >= 1000 ? 2200 : 1600;
    var startTime = null;

    function ease(t) { return 1 - Math.pow(1 - t, 3); }

    function tick(now) {
      if (!startTime) startTime = now;
      var progress = Math.min((now - startTime) / duration, 1);
      var value = Math.floor(ease(progress) * target);

      if (target >= 1000) {
        var k = value / 1000;
        el.textContent = k >= 1 ? (Number.isInteger(k) ? k + 'K' : k.toFixed(1) + 'K') : value;
      } else {
        el.textContent = value;
      }

      if (progress < 1) {
        requestAnimationFrame(tick);
      } else {
        el.textContent = target >= 1000 ? (target / 1000) + 'K' : target;
      }
    }

    requestAnimationFrame(tick);
  }

  function activate() {
    section.classList.add('visible');
    if (!started) {
      started = true;
      setTimeout(function () {
        section.querySelectorAll('.st-number').forEach(runCounter);
      }, 300);
    }
  }

  var observer = new IntersectionObserver(function (entries) {
    entries.forEach(function (e) {
      if (e.isIntersecting) { activate(); observer.disconnect(); }
    });
  }, { threshold: 0.15 });

  observer.observe(section);

  if (section.getBoundingClientRect().top < window.innerHeight * 0.92) {
    activate();
    observer.disconnect();
  }
})();
</script>
</body>
</html>