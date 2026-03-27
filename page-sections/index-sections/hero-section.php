<?php // Hero Section — GreenGrow Fertilizers ?>

<section class="gg-hero-scope" aria-label="Hero">
  <style>
    /* ══════════════════════════════════════════
       HERO SECTION (Scoped to .gg-hero-scope)
    ══════════════════════════════════════════ */
    .gg-hero-scope {
      --gg-hero-green-deep:   #0D2117;
      --gg-hero-green-dark:   #132D1E;
      --gg-hero-green-mid:    #1E4D30;
      --gg-hero-green-vivid:  #2E7D4F;
      --gg-hero-green-bright: #3DAA68;
      --gg-hero-gold:         #C8A84B;
      --gg-hero-gold-light:   #E2C472;
      --gg-hero-white:        #FFFFFF;
      --gg-hero-text-muted:   rgba(255,255,255,0.58);
      --gg-hero-font-display: 'Cormorant Garamond', Georgia, serif;
      --gg-hero-font-body:    'Outfit', sans-serif;
      --gg-hero-ease:         cubic-bezier(0.4, 0, 0.2, 1);
      --gg-hero-ease-out:     cubic-bezier(0.0, 0, 0.2, 1);
      --gg-hero-h-pad:        64px;
      --gg-hero-btn-h:        54px;

      position: relative;
      width: 100%;
      height: 100svh;
      min-height: 600px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      align-items: flex-start;
      overflow: hidden;
      font-family: var(--gg-hero-font-body);
      background: var(--gg-hero-green-deep);
      color: var(--gg-hero-white);
    }

    /* ── Reset scoped children ──────────────── */
    .gg-hero-scope *,
    .gg-hero-scope *::before,
    .gg-hero-scope *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    /* ── Background ─────────────────────────── */
    .gg-hero-scope .hero-bg {
      position: absolute;
      inset: 0;
      background-image: url('https://images.unsplash.com/photo-1625246333195-78d9c38ad449?w=1800&auto=format&fit=crop&q=80');
      background-size: cover;
      background-position: center 30%;
      transform: scale(1.06);
      animation: gg-hero-bg-drift 22s ease-in-out infinite alternate;
      will-change: transform;
      z-index: 1;
    }

    @keyframes gg-hero-bg-drift {
      from { transform: scale(1.06) translateX(0); }
      to   { transform: scale(1.06) translateX(-2%); }
    }

    /* ── Overlay ────────────────────────────── */
    .gg-hero-scope .hero-overlay {
      position: absolute;
      inset: 0;
      background:
        linear-gradient(105deg,
          rgba(13,33,23,0.93) 0%,
          rgba(13,33,23,0.78) 38%,
          rgba(13,33,23,0.42) 65%,
          rgba(13,33,23,0.60) 100%
        ),
        linear-gradient(to top, rgba(13,33,23,0.88) 0%, transparent 45%);
      z-index: 2;
    }

    /* ── Grid ───────────────────────────────── */
    .gg-hero-scope .hero-grid {
      position: absolute;
      inset: 0;
      background-image:
        linear-gradient(rgba(46,125,79,.07) 1px, transparent 1px),
        linear-gradient(90deg, rgba(46,125,79,.07) 1px, transparent 1px);
      background-size: 64px 64px;
      mask-image: linear-gradient(135deg, transparent 30%, rgba(0,0,0,.6) 70%);
      pointer-events: none;
      z-index: 3;
    }

    /* ── Nodes ──────────────────────────────── */
    .gg-hero-scope .hero-nodes {
      position: absolute;
      inset: 0;
      pointer-events: none;
      overflow: hidden;
      z-index: 4;
    }

    .gg-hero-scope .node {
      position: absolute;
      border-radius: 50%;
      opacity: 0;
      animation: gg-hero-node-appear 1.2s var(--gg-hero-ease-out) forwards;
    }

    .gg-hero-scope .node::after {
      content: '';
      position: absolute;
      top: 50%; left: 50%;
      width: 180%; height: 1px;
      background: linear-gradient(90deg, rgba(200,168,75,.4), transparent);
      transform: translateY(-50%);
      transform-origin: left;
    }

    .gg-hero-scope .node-1 { width:10px; height:10px; background:var(--gg-hero-gold);         top:22%; right:22%; animation-delay:1.4s; }
    .gg-hero-scope .node-2 { width:6px;  height:6px;  background:var(--gg-hero-green-bright); top:35%; right:30%; animation-delay:1.7s; }
    .gg-hero-scope .node-3 { width:8px;  height:8px;  background:var(--gg-hero-gold-light);   top:55%; right:18%; animation-delay:2.0s; }
    .gg-hero-scope .node-4 { width:5px;  height:5px;  background:var(--gg-hero-green-bright); top:68%; right:38%; animation-delay:2.2s; }
    .gg-hero-scope .node-5 { width:7px;  height:7px;  background:var(--gg-hero-gold);         top:28%; right:45%; animation-delay:2.5s; }

    @keyframes gg-hero-node-appear {
      from { opacity:0; transform:scale(0); }
      to   { opacity:1; transform:scale(1); }
    }

    .gg-hero-scope .node-lines {
      position: absolute;
      inset: 0;
      pointer-events: none;
      z-index: 4;
    }

    .gg-hero-scope .node-lines svg {
      width: 100%; height: 100%;
      opacity: 0;
      animation: gg-hero-fade-in 1s var(--gg-hero-ease-out) 2.6s forwards;
    }

    @keyframes gg-hero-fade-in { to { opacity:1; } }

    /* ══════════════════════════════════════════
       MAIN CONTENT
    ══════════════════════════════════════════ */
    .gg-hero-scope .hero-content {
      position: relative;
      z-index: 10;
      width: 100%;
      max-width: 1240px;
      margin: auto auto 0;
      padding: 100px var(--gg-hero-h-pad) 40px;
    }

    .gg-hero-scope .hero-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 12px;
      margin-bottom: clamp(12px, 2.5vh, 28px);
      opacity: 0;
      transform: translateY(20px);
      animation: gg-hero-reveal 0.7s var(--gg-hero-ease-out) 0.5s forwards;
    }

    .gg-hero-scope .eyebrow-line {
      display: block;
      width: 36px; height: 1px;
      background: var(--gg-hero-gold);
    }

    .gg-hero-scope .eyebrow-text {
      font-size: 0.75rem;
      font-weight: 600;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: var(--gg-hero-gold);
    }

    .gg-hero-scope .hero-headline {
      font-family: var(--gg-hero-font-display);
      font-size: clamp(2.4rem, 6.2vh, 6.4rem);
      font-weight: 700;
      line-height: 1.02;
      letter-spacing: -0.015em;
      color: var(--gg-hero-white);
      max-width: 820px;
      margin-bottom: clamp(16px, 3.2vh, 36px);
      opacity: 0;
      transform: translateY(28px);
      animation: gg-hero-reveal 0.8s var(--gg-hero-ease-out) 0.75s forwards;
    }

    .gg-hero-scope .hero-headline em {
      font-style: normal;
      color: transparent;
      -webkit-text-stroke: 1.5px var(--gg-hero-gold);
    }

    .gg-hero-scope .hero-headline .hl-green {
      color: var(--gg-hero-green-bright);
      -webkit-text-stroke: 0;
    }

    .gg-hero-scope .hero-desc {
      font-size: clamp(0.95rem, 1.4vw, 1.15rem);
      font-weight: 300;
      line-height: 1.7;
      color: var(--gg-hero-text-muted);
      max-width: 560px;
      margin-bottom: clamp(24px, 4.8vh, 56px);
      opacity: 0;
      transform: translateY(24px);
      animation: gg-hero-reveal 0.8s var(--gg-hero-ease-out) 1.0s forwards;
    }

    .gg-hero-scope .hero-desc strong {
      color: var(--gg-hero-white);
      font-weight: 500;
    }

    .gg-hero-scope .hero-cta-group {
      display: flex;
      align-items: center;
      gap: 24px;
      flex-wrap: wrap;
      opacity: 0;
      transform: translateY(20px);
      animation: gg-hero-reveal 0.8s var(--gg-hero-ease-out) 1.2s forwards;
    }

    .gg-hero-scope .btn-primary,
    .gg-hero-scope .btn-ghost {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      height: var(--gg-hero-btn-h);
      padding: 0 36px;
      border-radius: 4px;
      font-family: var(--gg-hero-font-body);
      font-size: 0.875rem;
      font-weight: 600;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      text-decoration: none;
      transition: all 0.35s var(--gg-hero-ease);
      white-space: nowrap;
    }

    .gg-hero-scope .btn-primary {
      position: relative;
      background: var(--gg-hero-gold);
      color: var(--gg-hero-green-deep);
      border: none;
      overflow: hidden;
      box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }

    .gg-hero-scope .btn-primary::before {
      content: '';
      position: absolute;
      inset: 0;
      background: var(--gg-hero-green-dark);
      transform: translateX(-101%);
      transition: transform 0.45s cubic-bezier(0.7,0,0.2,1);
    }

    .gg-hero-scope .btn-primary:hover {
      color: var(--gg-hero-gold);
      box-shadow: 0 12px 30px rgba(200,168,75,0.3);
      transform: translateY(-2px);
    }

    .gg-hero-scope .btn-primary:hover::before { transform: translateX(0); }

    .gg-hero-scope .btn-primary span,
    .gg-hero-scope .btn-primary svg { position: relative; z-index: 1; }

    .gg-hero-scope .btn-primary svg {
      width:18px; height:18px;
      margin-left: 12px;
      stroke: currentColor;
      stroke-width: 2.5;
      fill: none;
      transition: transform 0.3s var(--gg-hero-ease);
    }

    .gg-hero-scope .btn-primary:hover svg { transform: translateX(4px); }

    .gg-hero-scope .btn-ghost {
      background: transparent;
      color: var(--gg-hero-white);
      border: 1.5px solid rgba(255,255,255,0.15);
      gap: 12px;
    }

    .gg-hero-scope .btn-ghost svg {
      width:18px; height:18px;
      stroke: var(--gg-hero-gold);
      stroke-width: 2;
      fill: none;
    }

    .gg-hero-scope .btn-ghost:hover {
      border-color: var(--gg-hero-white);
      background: rgba(255,255,255,0.05);
      transform: translateY(-2px);
    }

    /* ══════════════════════════════════════════
       STATS
       Desktop  → single row, 4 columns
       ≤ 640px  → 2 × 2 grid, perfectly aligned
       ≤ 380px  → 2 × 2 grid, tighter
    ══════════════════════════════════════════ */
    .gg-hero-scope .hero-stats {
      position: relative;
      width: 100%;
      max-width: 1240px;
      margin: 0 auto;
      padding: 0 var(--gg-hero-h-pad) clamp(36px, 7vh, 60px);
      z-index: 10;
      opacity: 0;
      transform: translateY(16px);
      animation: gg-hero-reveal 0.8s var(--gg-hero-ease-out) 1.5s forwards;

      /* 4-column grid — each column equal width */
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 0;
    }

    /* Vertical dividers between columns */
    .gg-hero-scope .stat-item {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      padding: 0 clamp(16px, 2.5vw, 32px);
      border-left: 1px solid rgba(255,255,255,0.1);
    }

    .gg-hero-scope .stat-item:first-child {
      padding-left: 0;
      border-left: none;
    }

    .gg-hero-scope .stat-num {
      font-family: var(--gg-hero-font-display);
      font-size: clamp(1.9rem, 3.6vh, 3.4rem);
      font-weight: 700;
      color: var(--gg-hero-white);
      line-height: 1;
      margin-bottom: 6px;
      display: flex;
      align-items: baseline;
      gap: 2px;
    }

    .gg-hero-scope .stat-num span {
      color: var(--gg-hero-gold);
      font-size: 0.58em;
      font-weight: 600;
    }

    .gg-hero-scope .stat-label {
      font-size: clamp(0.65rem, 0.85vw, 0.78rem);
      font-weight: 500;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--gg-hero-text-muted);
      line-height: 1.35;
    }

    /* ── Scroll hint ────────────────────────── */
    .gg-hero-scope .scroll-hint {
      position: absolute;
      bottom: 56px;
      right: var(--gg-hero-h-pad);
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 12px;
      z-index: 10;
      opacity: 0;
      animation: gg-hero-reveal 1s var(--gg-hero-ease-out) 1.8s forwards;
    }

    .gg-hero-scope .scroll-hint-label {
      font-size: 0.65rem;
      font-weight: 600;
      letter-spacing: 0.25em;
      text-transform: uppercase;
      color: var(--gg-hero-text-muted);
      writing-mode: vertical-rl;
    }

    .gg-hero-scope .scroll-track {
      width: 1px; height: 60px;
      background: rgba(255,255,255,0.1);
      position: relative;
      overflow: hidden;
    }

    .gg-hero-scope .scroll-track::after {
      content: '';
      position: absolute;
      top: -40%; left: 0;
      width: 100%; height: 40%;
      background: var(--gg-hero-gold);
      animation: gg-hero-scroll-run 2.2s ease-in-out infinite;
    }

    @keyframes gg-hero-scroll-run {
      0%   { top: -40%; }
      100% { top: 140%; }
    }

    @keyframes gg-hero-reveal {
      to { opacity:1; transform:translateY(0); }
    }

    /* ══════════════════════════════════════════
       RESPONSIVE
    ══════════════════════════════════════════ */
    @media (max-width: 1024px) {
      .gg-hero-scope { --gg-hero-h-pad: 48px; }
      .gg-hero-scope .hero-content { padding-top: 80px; }
      .gg-hero-scope .scroll-hint  { display: none; }
    }

    @media (max-width: 860px) {
      .gg-hero-scope { --gg-hero-h-pad: 40px; }
      /* Hide decorative nodes on mid-size screens */
      .gg-hero-scope .node-1,
      .gg-hero-scope .node-2,
      .gg-hero-scope .node-3,
      .gg-hero-scope .node-4,
      .gg-hero-scope .node-5,
      .gg-hero-scope .node-lines { display: none; }
    }

    /* ── 2 × 2 grid for small screens ────────
       Triggers at 640px. Each cell is exactly
       half the container width, so all four
       stats form a perfectly aligned square.
    ───────────────────────────────────────── */
    @media (max-width: 640px) {
      .gg-hero-scope { --gg-hero-h-pad: 28px; }

      .gg-hero-scope .hero-stats {
        /* Switch to 2-column grid */
        grid-template-columns: 1fr 1fr;
        gap: 0;
        /* Extra bottom padding so content doesn't crowd the edge */
        padding-bottom: clamp(32px, 7vw, 52px);
      }

      /* Row divider between top and bottom rows */
      .gg-hero-scope .stat-item {
        padding: clamp(16px, 4vw, 24px) clamp(12px, 4vw, 24px);
        border-left: none;
        border-top: 1px solid rgba(255,255,255,0.1);
      }

      /* Top-left: no top border */
      .gg-hero-scope .stat-item:nth-child(1) {
        border-top: none;
        padding-left: 0;
      }

      /* Top-right: vertical divider on left, no top border */
      .gg-hero-scope .stat-item:nth-child(2) {
        border-top: none;
        border-left: 1px solid rgba(255,255,255,0.1);
      }

      /* Bottom-left: only top border */
      .gg-hero-scope .stat-item:nth-child(3) {
        padding-left: 0;
      }

      /* Bottom-right: top border + vertical divider */
      .gg-hero-scope .stat-item:nth-child(4) {
        border-left: 1px solid rgba(255,255,255,0.1);
      }

      .gg-hero-scope .stat-num   { font-size: clamp(1.7rem, 7vw, 2.2rem); }
      .gg-hero-scope .stat-label { font-size: clamp(0.6rem, 2.4vw, 0.72rem); }

      /* Stack CTA buttons */
      .gg-hero-scope .hero-cta-group { flex-direction: column; align-items: flex-start; gap: 14px; }
      .gg-hero-scope .btn-primary,
      .gg-hero-scope .btn-ghost      { width: 100%; max-width: 340px; }
    }

    @media (max-width: 480px) {
      .gg-hero-scope { --gg-hero-h-pad: 20px; }
      .gg-hero-scope .hero-content { padding-top: 70px; padding-bottom: 32px; }
      .gg-hero-scope .hero-headline { font-size: clamp(2rem, 8vw, 2.4rem); }

      .gg-hero-scope .stat-item {
        padding: clamp(14px, 3.5vw, 20px) clamp(10px, 3.5vw, 18px);
      }

      .gg-hero-scope .stat-item:nth-child(1),
      .gg-hero-scope .stat-item:nth-child(3) { padding-left: 0; }

      .gg-hero-scope .stat-num   { font-size: clamp(1.5rem, 6.5vw, 1.9rem); }
      .gg-hero-scope .stat-label { font-size: clamp(0.58rem, 2.2vw, 0.68rem); }
    }

    @media (max-width: 360px) {
      .gg-hero-scope .stat-num   { font-size: 1.4rem; }
      .gg-hero-scope .stat-label { font-size: 0.58rem; letter-spacing: 0.06em; }
    }
  </style>

  <div class="hero-bg" role="img" aria-label="Aerial view of lush green farmland"></div>
  <div class="hero-overlay"></div>
  <div class="hero-grid"></div>

  <div class="hero-nodes" aria-hidden="true">
    <div class="node node-1"></div>
    <div class="node node-2"></div>
    <div class="node node-3"></div>
    <div class="node node-4"></div>
    <div class="node node-5"></div>
  </div>

  <div class="node-lines" aria-hidden="true">
    <svg viewBox="0 0 1440 900" preserveAspectRatio="xMidYMid slice" xmlns="http://www.w3.org/2000/svg">
      <line x1="1123" y1="198" x2="950"  y2="315" stroke="rgba(200,168,75,0.2)"  stroke-width="1"/>
      <line x1="950"  y1="315" x2="1062" y2="495" stroke="rgba(46,125,79,0.2)"   stroke-width="1"/>
      <line x1="1062" y1="495" x2="850"  y2="612" stroke="rgba(200,168,75,0.15)" stroke-width="1"/>
      <line x1="1123" y1="198" x2="648"  y2="252" stroke="rgba(46,125,79,0.15)"  stroke-width="1"/>
    </svg>
  </div>

  <div class="hero-content">
    <div class="hero-eyebrow" aria-label="Category">
      <span class="eyebrow-line"></span>
      <span class="eyebrow-text">Advanced Agricultural Chemistry</span>
    </div>

    <h1 class="hero-headline">
      Cultivate the&nbsp;<em>Future</em><br>
      of <span class="hl-green">Sustainable</span><br>
      Agriculture
    </h1>

    <p class="hero-desc">
      Precision-engineered fertilizers that <strong>increase crop yields by up to 40%</strong>
      while restoring soil microbiome health — delivering measurable results across
      every season, every climate, every crop.
    </p>

    <div class="hero-cta-group">
      <a href="#products" class="btn-primary">
        <span>Explore Products</span>
        <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
      </a>
      <a href="#research" class="btn-ghost">
        <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"/><polygon points="10 8 16 12 10 16 10 8"/></svg>
        Watch Field Results
      </a>
    </div>
  </div>

  <div class="hero-stats" aria-label="Key figures">
    <div class="stat-item">
      <div class="stat-num" data-target="40"  data-suffix="%">40<span>%</span></div>
      <div class="stat-label">Avg. Yield Increase</div>
    </div>
    <div class="stat-item">
      <div class="stat-num" data-target="120" data-suffix="+">120<span>+</span></div>
      <div class="stat-label">Crop Varieties Tested</div>
    </div>
    <div class="stat-item">
      <div class="stat-num" data-target="58"  data-suffix="K">58<span>K</span></div>
      <div class="stat-label">Hectares Improved</div>
    </div>
    <div class="stat-item">
      <div class="stat-num" data-target="99"  data-suffix="%">99<span>%</span></div>
      <div class="stat-label">Soil Safety Rating</div>
    </div>
  </div>

  <div class="scroll-hint" aria-hidden="true">
    <span class="scroll-hint-label">Scroll</span>
    <div class="scroll-track"></div>
  </div>

  <script>
    (function () {
      var scope   = document.querySelector('.gg-hero-scope');
      var bg      = scope.querySelector('.hero-bg');
      var overlay = scope.querySelector('.hero-overlay');

      /* ── Parallax ──────────────────────────── */
      var ticking = false;
      window.addEventListener('scroll', function () {
        if (!ticking) {
          requestAnimationFrame(function () {
            var scrollY = window.scrollY;
            var heroH   = scope.offsetHeight;
            if (scrollY < heroH) {
              var pct = scrollY / heroH;
              bg.style.transform =
                'scale(1.06) translateY(' + (scrollY * 0.22) + 'px)';
              overlay.style.background =
                'linear-gradient(105deg,' +
                'rgba(13,33,23,' + (0.93 + pct * 0.07) + ') 0%,' +
                'rgba(13,33,23,' + (0.78 + pct * 0.12) + ') 38%,' +
                'rgba(13,33,23,' + (0.42 + pct * 0.38) + ') 65%,' +
                'rgba(13,33,23,' + (0.60 + pct * 0.30) + ') 100%)';
            }
            ticking = false;
          });
          ticking = true;
        }
      });

      /* ── Count-up ──────────────────────────── */
      function countUp(el, target, suffix, duration) {
        var start = performance.now();
        (function update(now) {
          var elapsed = Math.min((now - start) / duration, 1);
          var eased   = 1 - Math.pow(1 - elapsed, 3);
          el.innerHTML = Math.floor(eased * target) + '<span>' + suffix + '</span>';
          if (elapsed < 1) requestAnimationFrame(update);
        })(start);
      }

      var observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            scope.querySelectorAll('.stat-num').forEach(function (el) {
              countUp(el, parseInt(el.dataset.target, 10), el.dataset.suffix || '', 2000);
            });
            observer.disconnect();
          }
        });
      }, { threshold: 0.3 });

      var statsEl = scope.querySelector('.hero-stats');
      if (statsEl) observer.observe(statsEl);
    })();
  </script>
</section>