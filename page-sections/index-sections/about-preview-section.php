<?php // About Section Preview — AgroFanema ?>

<section class="gg-about-scope" id="gg-about-preview" aria-label="About AgroFanema Preview">
<style>
  /* ══════════════════════════════════════════════════════
     ALL styles scoped to .gg-about-scope
  ══════════════════════════════════════════════════════ */

  .gg-about-scope {
    --ab-green-deep:    #0D2117;
    --ab-green-dark:    #132D1E;
    --ab-green-mid:     #1E4D30;
    --ab-green-vivid:   #2E7D4F;
    --ab-green-bright:  #3DAA68;
    --ab-gold:          #C8A84B;
    --ab-gold-light:    #E2C472;
    --ab-white:         #FFFFFF;
    --ab-bg:            #F5F2EA;
    --ab-text:          #1A1A1A;
    --ab-text-mid:      #3A3A36;
    --ab-text-muted:    #6B6B62;
    --ab-border:        #E2E0DA;
    --ab-shadow:        rgba(26,51,41,0.10);
    --ab-shadow-deep:   rgba(26,51,41,0.24);
    --ab-font-display:  'Cormorant Garamond', Georgia, serif;
    --ab-font-body:     'Outfit', sans-serif;
    --ab-ease:          cubic-bezier(0.4, 0, 0.2, 1);
    --ab-ease-out:      cubic-bezier(0.0, 0, 0.2, 1);
    --ab-h-pad:         80px;
  }

  .gg-about-scope *,
  .gg-about-scope *::before,
  .gg-about-scope *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  .gg-about-scope {
    position: relative;
    width: 100%;
    background: var(--ab-bg);
    overflow: visible; /* allow lightbox to escape */
    font-family: var(--ab-font-body);
    color: var(--ab-text);
  }

  .gg-about-scope::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image:
      radial-gradient(ellipse 80% 60% at 0% 100%, rgba(46,125,79,.05) 0%, transparent 65%),
      radial-gradient(ellipse 60% 80% at 100% 0%,  rgba(200,168,75,.04) 0%, transparent 60%);
    pointer-events: none;
    z-index: 0;
  }

  /* ── Inner grid ───────────────────────────────────────── */
  .gg-about-scope .ab-inner {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 1400px; /* Expanded from 1280px */
    margin: 0 auto;
    padding: clamp(72px, 9vw, 120px) var(--ab-h-pad);
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: clamp(48px, 6vw, 96px);
    align-items: center;
  }

  /* ══════════════════════════════════════════
     LEFT — IMAGE COLUMN
  ══════════════════════════════════════════ */
  .gg-about-scope .ab-image-col {
    position: relative;
  }

  /* Gold corner bracket */
  .gg-about-scope .ab-corner {
    position: absolute;
    top: -14px; left: -14px;
    width: 72px; height: 72px;
    pointer-events: none;
    z-index: 2;
    opacity: 0;
    transform: translate(-6px, -6px);
    transition: opacity 0.6s var(--ab-ease) 0.7s, transform 0.6s var(--ab-ease) 0.7s;
  }

  .gg-about-scope.ab-visible .ab-corner {
    opacity: 1; transform: translate(0,0);
  }

  .gg-about-scope .ab-corner::before,
  .gg-about-scope .ab-corner::after {
    content: ''; position: absolute; background: var(--ab-gold);
  }

  .gg-about-scope .ab-corner::before { top:0; left:0; width:100%; height:2px; }
  .gg-about-scope .ab-corner::after  { top:0; left:0; width:2px;  height:100%; }

  /* Image frame */
  .gg-about-scope .ab-img-frame {
    position: relative;
    width: 100%;
    aspect-ratio: 4 / 5;
    border-radius: 4px;
    overflow: hidden;
    cursor: zoom-in;
    clip-path: inset(100% 0 0 0);
    transition: clip-path 0.9s cubic-bezier(0.77,0,0.175,1);
  }

  .gg-about-scope.ab-visible .ab-img-frame {
    clip-path: inset(0% 0 0 0);
  }

  .gg-about-scope .ab-img-frame img {
    width: 100%; height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
    transform: scale(1.08);
    transition: transform 1s var(--ab-ease) 0.1s;
  }

  .gg-about-scope.ab-visible .ab-img-frame img {
    transform: scale(1);
  }

  .gg-about-scope .ab-img-frame:hover img {
    transform: scale(1.04);
  }

  /* Dark gradient overlay on image */
  .gg-about-scope .ab-img-frame::after {
    content: '';
    position: absolute; inset: 0;
    background: linear-gradient(160deg, rgba(13,33,23,.10) 0%, transparent 45%, rgba(13,33,23,.20) 100%);
    pointer-events: none;
    transition: background 0.3s var(--ab-ease);
  }

  .gg-about-scope .ab-img-frame:hover::after {
    background: linear-gradient(160deg, rgba(13,33,23,.22) 0%, rgba(13,33,23,.05) 45%, rgba(13,33,23,.35) 100%);
  }

  /* Zoom icon overlay */
  .gg-about-scope .ab-zoom-icon {
    position: absolute;
    bottom: 18px; right: 18px;
    width: 40px; height: 40px;
    background: rgba(13,33,23,0.72);
    border: 1px solid rgba(200,168,75,0.45);
    border-radius: 3px;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2;
    opacity: 0;
    transform: scale(0.85);
    transition: opacity 0.25s var(--ab-ease), transform 0.25s var(--ab-ease);
    pointer-events: none;
  }

  .gg-about-scope .ab-zoom-icon svg {
    width: 18px; height: 18px;
    stroke: var(--ab-gold);
    stroke-width: 1.8;
    fill: none;
  }

  .gg-about-scope .ab-img-frame:hover .ab-zoom-icon {
    opacity: 1; transform: scale(1);
  }

  /* Years badge */
  .gg-about-scope .ab-badge {
    position: absolute;
    bottom: -20px; right: -20px;
    width: 120px; height: 120px;
    background: var(--ab-green-deep);
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 2px;
    box-shadow: 0 8px 32px var(--ab-shadow-deep);
    z-index: 3;
    opacity: 0;
    transform: scale(0.7) rotate(-12deg);
    transition: opacity 0.55s var(--ab-ease) 0.85s, transform 0.55s var(--ab-ease) 0.85s;
  }

  .gg-about-scope.ab-visible .ab-badge {
    opacity: 1; transform: scale(1) rotate(0deg);
  }

  .gg-about-scope .ab-badge:hover {
    transform: scale(1.06) rotate(3deg);
    box-shadow: 0 14px 40px var(--ab-shadow-deep);
  }

  .gg-about-scope .ab-badge::before {
    content: '';
    position: absolute; inset: -4px;
    border-radius: 50%;
    border: 1.5px solid rgba(200,168,75,.35);
    pointer-events: none;
  }

  .gg-about-scope .ab-badge-num {
    font-family: var(--ab-font-display);
    font-size: 2rem; font-weight: 700;
    color: var(--ab-white); line-height: 1;
  }

  .gg-about-scope .ab-badge-num span { color: var(--ab-gold); font-size: .7em; font-weight: 600; }

  .gg-about-scope .ab-badge-label {
    font-size: .52rem; font-weight: 600;
    letter-spacing: .14em; text-transform: uppercase;
    color: rgba(255,255,255,.65);
    text-align: center; line-height: 1.3;
    padding: 0 10px;
  }

  /* ══════════════════════════════════════════
     RIGHT — TEXT COLUMN
  ══════════════════════════════════════════ */
  .gg-about-scope .ab-text-col {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
  }

  /* Eyebrow */
  .gg-about-scope .ab-eyebrow {
    display: inline-flex; align-items: center; gap: 12px;
    margin-bottom: 20px;
    opacity: 0; transform: translateY(18px);
    transition: opacity .6s var(--ab-ease-out) .15s, transform .6s var(--ab-ease-out) .15s;
  }

  .gg-about-scope.ab-visible .ab-eyebrow { opacity:1; transform:translateY(0); }

  .gg-about-scope .ab-eyebrow-line {
    display: block; width: 36px; height: 1.5px;
    background: var(--ab-gold); flex-shrink: 0;
  }

  .gg-about-scope .ab-eyebrow-text {
    font-size: .72rem; font-weight: 600;
    letter-spacing: .22em; text-transform: uppercase;
    color: var(--ab-gold);
  }

  /* Headline */
  .gg-about-scope .ab-headline {
    font-family: var(--ab-font-display);
    font-size: clamp(2.2rem, 4vw, 3.8rem);
    font-weight: 700; line-height: 1.06;
    letter-spacing: -.01em;
    color: var(--ab-green-deep);
    margin-bottom: 20px;
    opacity: 0; transform: translateY(22px);
    transition: opacity .7s var(--ab-ease-out) .28s, transform .7s var(--ab-ease-out) .28s;
  }

  .gg-about-scope.ab-visible .ab-headline { opacity:1; transform:translateY(0); }
  .gg-about-scope .ab-headline em { font-style: italic; color: var(--ab-green-vivid); }

  /* Gold rule */
  .gg-about-scope .ab-rule {
    width: 48px; height: 2px;
    background: linear-gradient(90deg, var(--ab-gold), var(--ab-gold-light), transparent);
    margin-bottom: 22px;
    opacity: 0; transform: scaleX(0); transform-origin: left;
    transition: opacity .5s var(--ab-ease) .42s, transform .5s var(--ab-ease) .42s;
  }

  .gg-about-scope.ab-visible .ab-rule { opacity:1; transform:scaleX(1); }

  /* Body */
  .gg-about-scope .ab-body {
    font-size: clamp(.92rem, 1.3vw, 1.04rem);
    font-weight: 300; line-height: 1.82;
    color: var(--ab-text-mid);
    margin-bottom: 14px;
    opacity: 0; transform: translateY(18px);
    transition: opacity .7s var(--ab-ease-out) .5s, transform .7s var(--ab-ease-out) .5s;
  }

  .gg-about-scope .ab-body + .ab-body { transition-delay: .62s; }
  .gg-about-scope.ab-visible .ab-body { opacity:1; transform:translateY(0); }
  .gg-about-scope .ab-body strong { font-weight: 600; color: var(--ab-green-deep); }

  /* ══════════════════════════════════════════
     PILLS — 2×2 grid with modern card feel
  ══════════════════════════════════════════ */
  .gg-about-scope .ab-pills {
    width: 100%;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    margin: 24px 0 40px;
    opacity: 0; transform: translateY(14px);
    transition: opacity .65s var(--ab-ease-out) .68s, transform .65s var(--ab-ease-out) .68s;
  }

  .gg-about-scope.ab-visible .ab-pills { opacity:1; transform:translateY(0); }

  .gg-about-scope .ab-pill {
    display: flex;
    flex-direction: row; /* Row instead of column */
    align-items: center; /* Center horizontally */
    gap: 12px;
    padding: 16px 20px;
    background: #FFFFFF;
    border: 1px solid var(--ab-border);
    border-radius: 8px;
    font-size: .8rem;
    font-weight: 600;
    letter-spacing: .02em;
    color: var(--ab-green-deep);
    text-transform: none; /* remove uppercase for modern feel */
    transition: all .3s var(--ab-ease);
    box-shadow: 0 4px 12px rgba(26, 51, 41, 0.03);
    cursor: default;
  }

  .gg-about-scope .ab-pill:hover {
    background: #FFFFFF;
    border-color: var(--ab-gold);
    transform: translateY(-3px);
    box-shadow: 0 8px 24px rgba(26, 51, 41, 0.08);
  }

  .gg-about-scope .ab-pill svg {
    width: 20px; height: 20px;
    stroke: var(--ab-gold);
    stroke-width: 2; fill: none;
    flex-shrink: 0;
    padding: 4px;
    background: rgba(200, 168, 75, 0.1);
    border-radius: 6px;
    transition: all .3s;
  }

  .gg-about-scope .ab-pill:hover svg { 
    background: var(--ab-gold);
    stroke: #FFFFFF;
  }

  /* ══════════════════════════════════════════
     CTAs
  ══════════════════════════════════════════ */
  .gg-about-scope .ab-cta-wrap {
    display: flex; align-items: center;
    gap: 24px; flex-wrap: wrap;
    opacity: 0; transform: translateY(14px);
    transition: opacity .65s var(--ab-ease-out) .82s, transform .65s var(--ab-ease-out) .82s;
  }

  .gg-about-scope.ab-visible .ab-cta-wrap { opacity:1; transform:translateY(0); }

  .gg-about-scope .ab-btn {
    position: relative;
    display: inline-flex; align-items: center; gap: 12px;
    padding: 0 32px; height: 52px;
    background: var(--ab-green-deep);
    color: var(--ab-white);
    font-family: var(--ab-font-body);
    font-size: .82rem; font-weight: 600;
    letter-spacing: .1em; text-transform: uppercase;
    text-decoration: none; border-radius: 100px;
    overflow: hidden;
    transition: box-shadow .3s var(--ab-ease), transform .25s var(--ab-ease), color .35s var(--ab-ease);
  }

  .gg-about-scope .ab-btn::before {
    content: ''; position: absolute; inset: 0;
    background: var(--ab-gold);
    transform: translateX(-101%);
    transition: transform .42s cubic-bezier(.77,0,.175,1);
  }

  .gg-about-scope .ab-btn:hover {
    color: var(--ab-green-deep);
    box-shadow: 0 10px 34px rgba(200,168,75,.3);
  }

  .gg-about-scope .ab-btn:hover::before { transform: translateX(0); }

  .gg-about-scope .ab-btn span,
  .gg-about-scope .ab-btn svg { position: relative; z-index: 1; }

  .gg-about-scope .ab-btn svg {
    width: 16px; height: 16px;
    stroke: currentColor; stroke-width: 2.2;
    fill: none; stroke-linecap: round; stroke-linejoin: round;
    transition: transform .28s var(--ab-ease);
  }

  .gg-about-scope .ab-btn:hover svg { transform: translateX(4px); }

  .gg-about-scope .ab-link {
    display: inline-flex; align-items: center; gap: 8px;
    font-size: .82rem; font-weight: 500;
    color: var(--ab-text-muted);
    text-decoration: none; letter-spacing: .04em;
    border-bottom: 1px solid transparent; padding-bottom: 2px;
    transition: color .25s var(--ab-ease), border-color .25s var(--ab-ease);
  }

  .gg-about-scope .ab-link svg {
    width: 14px; height: 14px;
    stroke: currentColor; stroke-width: 2; fill: none;
    transition: transform .25s var(--ab-ease);
  }

  .gg-about-scope .ab-link:hover { color: var(--ab-green-vivid); border-color: var(--ab-green-vivid); background: rgba(0,0,0,0.02); }
  .gg-about-scope .ab-link:hover svg { transform: translateX(3px); }

  /* Side label */
  .gg-about-scope .ab-side-label {
    position: absolute;
    left: 18px; top: 50%;
    transform: translateY(-50%) rotate(-90deg);
    font-size: .58rem; font-weight: 600;
    letter-spacing: .28em; text-transform: uppercase;
    color: rgba(26,51,41,.18);
    white-space: nowrap; pointer-events: none;
    z-index: 1; user-select: none;
  }

  /* Bottom strip */
  .gg-about-scope .ab-strip {
    position: relative; z-index: 1;
    width: 100%; height: 3px;
    background: linear-gradient(90deg,
      var(--ab-green-deep) 0%, var(--ab-green-vivid) 35%,
      var(--ab-gold) 55%, var(--ab-green-bright) 80%, transparent 100%
    );
    opacity: .55;
  }

  /* ══════════════════════════════════════════
     LIGHTBOX
  ══════════════════════════════════════════ */
  .gg-about-scope .ab-lightbox {
    position: fixed;
    inset: 0;
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 24px;
    /* Hidden state */
    opacity: 0;
    visibility: hidden;
    transition: opacity .38s var(--ab-ease), visibility .38s var(--ab-ease);
  }

  .gg-about-scope .ab-lightbox.ab-lb-open {
    opacity: 1;
    visibility: visible;
  }

  /* Backdrop */
  .gg-about-scope .ab-lb-backdrop {
    position: absolute; inset: 0;
    background: rgba(8,20,12,.88);
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    cursor: zoom-out;
  }

  /* Panel */
  .gg-about-scope .ab-lb-panel {
    position: relative;
    z-index: 1;
    display: flex;
    flex-direction: column;
    max-width: 900px;
    width: 100%;
    background: var(--ab-green-dark);
    border: 1px solid rgba(200,168,75,.18);
    border-radius: 6px;
    overflow: hidden;
    box-shadow: 0 40px 120px rgba(0,0,0,.65), 0 0 0 1px rgba(200,168,75,.08);
    transform: scale(.94) translateY(16px);
    transition: transform .42s cubic-bezier(.25,.46,.45,.94);
  }

  .gg-about-scope .ab-lightbox.ab-lb-open .ab-lb-panel {
    transform: scale(1) translateY(0);
  }

  /* Gold top rule */
  .gg-about-scope .ab-lb-panel::before {
    content: '';
    position: absolute; top:0; left:0; right:0;
    height: 2px;
    background: linear-gradient(90deg, transparent, var(--ab-gold) 30%, var(--ab-gold-light) 60%, transparent);
    z-index: 2;
  }

  /* Image area */
  .gg-about-scope .ab-lb-img-wrap {
    position: relative;
    width: 100%;
    aspect-ratio: 16/10;
    overflow: hidden;
    background: var(--ab-green-deep);
  }

  .gg-about-scope .ab-lb-img-wrap img {
    width: 100%; height: 100%;
    object-fit: cover;
    object-position: center;
    display: block;
    transition: transform 6s ease;
  }

  .gg-about-scope .ab-lightbox.ab-lb-open .ab-lb-img-wrap img {
    transform: scale(1.04);
  }

  /* Caption bar */
  .gg-about-scope .ab-lb-caption {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 28px;
    gap: 20px;
  }

  .gg-about-scope .ab-lb-caption-left {
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .gg-about-scope .ab-lb-title {
    font-family: var(--ab-font-display);
    font-size: 1.15rem; font-weight: 600;
    color: var(--ab-white);
    letter-spacing: .01em;
    line-height: 1.2;
  }

  .gg-about-scope .ab-lb-sub {
    font-size: .72rem; font-weight: 400;
    letter-spacing: .1em; text-transform: uppercase;
    color: rgba(255,255,255,.45);
  }

  /* Close button */
  .gg-about-scope .ab-lb-close {
    display: flex; align-items: center; gap: 8px;
    padding: 9px 18px;
    background: rgba(200,168,75,.12);
    border: 1px solid rgba(200,168,75,.25);
    border-radius: 3px;
    color: var(--ab-gold);
    font-family: var(--ab-font-body);
    font-size: .72rem; font-weight: 600;
    letter-spacing: .1em; text-transform: uppercase;
    cursor: pointer;
    white-space: nowrap;
    flex-shrink: 0;
    transition: background .22s var(--ab-ease), border-color .22s var(--ab-ease), color .22s var(--ab-ease);
  }

  .gg-about-scope .ab-lb-close svg {
    width: 14px; height: 14px;
    stroke: currentColor; stroke-width: 2.2; fill: none;
  }

  .gg-about-scope .ab-lb-close:hover {
    background: var(--ab-gold);
    border-color: var(--ab-gold);
    color: var(--ab-green-deep);
  }

  /* ── Keyboard hint ──── */
  .gg-about-scope .ab-lb-esc-hint {
    position: absolute;
    top: 18px; right: 18px;
    font-size: .6rem; font-weight: 500;
    letter-spacing: .1em; text-transform: uppercase;
    color: rgba(255,255,255,.3);
    pointer-events: none;
    z-index: 3;
  }

  /* ══════════════════════════════════════════
     RESPONSIVE
  ══════════════════════════════════════════ */
  @media (max-width: 1100px) {
    .gg-about-scope { --ab-h-pad: 48px; }
    .gg-about-scope .ab-inner { gap: clamp(36px,5vw,64px); }
  }

  @media (max-width: 860px) {
    .gg-about-scope { --ab-h-pad: 36px; }
    .gg-about-scope .ab-inner { grid-template-columns: 1fr; gap: 48px; }
    .gg-about-scope .ab-image-col { max-width: 520px; margin: 0 auto; width: 100%; }
    .gg-about-scope .ab-img-frame { aspect-ratio: 4/3; }
    .gg-about-scope .ab-badge { right:12px; bottom:-16px; width:104px; height:104px; }
    .gg-about-scope .ab-badge-num { font-size: 1.65rem; }
    .gg-about-scope .ab-side-label { display: none; }
    /* Pills stay 2-col on tablet — no change needed */
  }

  @media (max-width: 560px) {
    .gg-about-scope { --ab-h-pad: 22px; }
    .gg-about-scope .ab-inner { padding-top: clamp(52px,8vw,80px); padding-bottom: clamp(52px,8vw,80px); }
    .gg-about-scope .ab-img-frame { aspect-ratio: 4/3; }
    .gg-about-scope .ab-headline { font-size: clamp(1.9rem,7vw,2.6rem); }
    .gg-about-scope .ab-cta-wrap { flex-direction: column; align-items: flex-start; gap: 16px; }
    .gg-about-scope .ab-btn { width: 100%; max-width: 320px; justify-content: center; }
    .gg-about-scope .ab-badge { width:84px; height:84px; right:8px; bottom:-12px; }
    .gg-about-scope .ab-badge-num { font-size: 1.3rem; }
    .gg-about-scope .ab-badge-label { font-size: .46rem; }
    /* On small screens, keep 2 columns but smaller padding */
    .gg-about-scope .ab-pills { grid-template-columns: 1fr 1fr; gap: 10px; }
    .gg-about-scope .ab-pill { padding: 16px; gap: 10px; font-size: 0.75rem; }
    .gg-about-scope .ab-pill svg { width: 18px; height: 18px; padding: 3px; }
    
    .gg-about-scope .ab-lb-caption { flex-direction: column; align-items: flex-start; }
    .gg-about-scope .ab-lb-close { align-self: flex-end; }
  }

  @media (max-width: 380px) {
    .gg-about-scope { --ab-h-pad: 16px; }
    .gg-about-scope .ab-pills { grid-template-columns: 1fr; } /* Stack on very tiny screens */
    .gg-about-scope .ab-pill { padding: 14px 16px; }
  }
</style>

  <span class="ab-side-label" aria-hidden="true">AgroFanema — <?php echo t('est'); ?> 1994</span>

  <div class="ab-inner">

    <!-- ══ LEFT: Image column ══════════════════════════════ -->
    <div class="ab-image-col">
      <div class="ab-corner" aria-hidden="true"></div>

      <!-- Clickable image frame -->
      <div class="ab-img-frame" id="ab-img-trigger" role="button" tabindex="0"
           aria-label="View enlarged product image" aria-haspopup="dialog">
        <!--
          Premium fertilizer granules product shot — clean, magazine quality.
          Unsplash: Marcin Jozwiak — mineral granules macro
        -->
        <img
          src="https://images.unsplash.com/photo-1587049352846-4a222e784d38?w=900&auto=format&fit=crop&q=85"
          alt="Close-up of premium mineral fertilizer granules — GreenGrow NPK product line"
          loading="lazy"
        />
        <!-- Zoom hint icon -->
        <div class="ab-zoom-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="7"/>
            <line x1="21" y1="21" x2="16.65" y2="16.65"/>
            <line x1="11" y1="8" x2="11" y2="14"/>
            <line x1="8" y1="11" x2="14" y2="11"/>
          </svg>
        </div>
      </div>

      <!-- Floating years badge -->
      <div class="ab-badge" aria-label="<?php echo t('years_excellence'); ?>">
        <div class="ab-badge-num">32<span>+</span></div>
        <div class="ab-badge-label"><?php echo t('years_excellence'); ?></div>
      </div>
    </div>

    <!-- ══ RIGHT: Text column ══════════════════════════════ -->
    <div class="ab-text-col">

      <div class="ab-eyebrow" aria-label="<?php echo t('who_we_are'); ?>">
        <span class="ab-eyebrow-line"></span>
        <span class="ab-eyebrow-text"><?php echo t('who_we_are'); ?></span>
      </div>

      <h2 class="ab-headline">
        <?php echo t('science_backed'); ?><br><?php echo t('for'); ?> <em><?php echo t('thriving'); ?></em> <?php echo t('harvests'); ?>
      </h2>

      <div class="ab-rule" aria-hidden="true"></div>

      <p class="ab-body">
        <?php echo t('founded'); ?> 1994, <strong>AgroFanema</strong> <?php echo t('about_summary_1'); ?>
      </p>

      <p class="ab-body">
        <?php echo t('about_summary_2'); ?>
      </p>

      <!-- 2×2 pill grid -->
      <div class="ab-pills" role="list">
        <div class="ab-pill" role="listitem">
          <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
          <?php echo t('soil_safe'); ?>
        </div>
        <div class="ab-pill" role="listitem">
          <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
          <?php echo t('iso_certified'); ?>
        </div>
        <div class="ab-pill" role="listitem">
          <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
          <?php echo t('rd_driven'); ?>
        </div>
        <div class="ab-pill" role="listitem">
          <svg viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12"/></svg>
          <?php echo t('countries_count'); ?>
        </div>
      </div>

      <div class="ab-cta-wrap">
        <a href="about.php" class="ab-btn">
          <span><?php echo t('learn_more'); ?></span>
          <svg viewBox="0 0 24 24">
            <line x1="5" y1="12" x2="19" y2="12"/>
            <polyline points="12 5 19 12 12 19"/>
          </svg>
        </a>
        <a href="contact.php" class="ab-link">
          <?php echo t('talk_expert'); ?>
          <svg viewBox="0 0 24 24">
            <line x1="5" y1="12" x2="19" y2="12"/>
            <polyline points="12 5 19 12 12 19"/>
          </svg>
        </a>
      </div>

    </div>
  </div>

  <div class="ab-strip" aria-hidden="true"></div>

  <!-- ══ LIGHTBOX ════════════════════════════════════════ -->
  <div class="ab-lightbox" id="ab-lightbox" role="dialog" aria-modal="true"
       aria-label="Product image viewer" aria-hidden="true">

    <div class="ab-lb-backdrop" id="ab-lb-backdrop"></div>

    <div class="ab-lb-panel">
      <span class="ab-lb-esc-hint"><?php echo t('esc_to_close'); ?></span>

      <div class="ab-lb-img-wrap">
        <img
          src="https://images.unsplash.com/photo-1587049352846-4a222e784d38?w=1400&auto=format&fit=crop&q=90"
          alt="GreenGrow premium NPK fertilizer granules — professional product photography"
        />
      </div>

      <div class="ab-lb-caption">
        <div class="ab-lb-caption-left">
          <div class="ab-lb-title">GreenGrow NPK Premium Granule Series</div>
          <div class="ab-lb-sub">Precision-formulated mineral fertilizer · Macro photography</div>
        </div>
        <button class="ab-lb-close" id="ab-lb-close-btn" aria-label="<?php echo t('close'); ?>">
          <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"/>
            <line x1="6" y1="6" x2="18" y2="18"/>
          </svg>
          <?php echo t('close'); ?>
        </button>
      </div>
    </div>
  </div>

  <script>
  (function () {
    var scope      = document.querySelector('.gg-about-scope');
    var trigger    = document.getElementById('ab-img-trigger');
    var lightbox   = document.getElementById('ab-lightbox');
    var backdrop   = document.getElementById('ab-lb-backdrop');
    var closeBtn   = document.getElementById('ab-lb-close-btn');

    if (!scope) return;

    /* ── Scroll-in entrance ──────────────────── */
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          scope.classList.add('ab-visible');
          io.disconnect();
        }
      });
    }, { threshold: 0.12 });
    io.observe(scope);

    var rect = scope.getBoundingClientRect();
    if (rect.top < window.innerHeight * 0.88) {
      scope.classList.add('ab-visible');
      io.disconnect();
    }

    /* ── Lightbox open / close ───────────────── */
    function openLightbox() {
      lightbox.classList.add('ab-lb-open');
      lightbox.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';
      closeBtn.focus();
    }

    function closeLightbox() {
      lightbox.classList.remove('ab-lb-open');
      lightbox.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
      trigger.focus();
    }

    if (trigger) {
      trigger.addEventListener('click', openLightbox);
      trigger.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ' ') {
          e.preventDefault();
          openLightbox();
        }
      });
    }

    if (backdrop)  backdrop.addEventListener('click', closeLightbox);
    if (closeBtn)  closeBtn.addEventListener('click', closeLightbox);

    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape' && lightbox.classList.contains('ab-lb-open')) {
        closeLightbox();
      }
    });
  })();
  </script>

</section>