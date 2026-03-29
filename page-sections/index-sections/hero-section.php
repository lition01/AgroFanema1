<?php // Hero Section — AgroFanema ?>

<section class="gg-hero-scope" id="gg-hero" aria-label="AgroFanema Hero Section">
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
      height: calc(100vh - 68px); /* Account for the fixed 68px navbar height */
      height: calc(100svh - 68px); /* Use dynamic viewport height for better mobile fit */
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
      max-width: 1400px; /* Expanded from 1240px */
      margin: 0 auto;
      padding: 60px var(--gg-hero-h-pad) 20px;
    }

    .gg-hero-scope .hero-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 12px;
      margin-bottom: clamp(12px, 2.5vh, 28px);
      opacity: 0;
      animation: gg-hero-reveal 1.2s cubic-bezier(0.19, 1, 0.22, 1) 0.5s forwards;
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
      animation: gg-hero-reveal 1.2s cubic-bezier(0.19, 1, 0.22, 1) 0.7s forwards;
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
      animation: gg-hero-reveal 1.2s cubic-bezier(0.19, 1, 0.22, 1) 0.9s forwards;
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
      animation: gg-hero-reveal 1.2s cubic-bezier(0.19, 1, 0.22, 1) 1.1s forwards;
    }

    .gg-hero-scope .btn-primary,
    .gg-hero-scope .btn-ghost {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      height: var(--gg-hero-btn-h);
      padding: 0 36px;
      border-radius: 100px;
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
      box-shadow: 0 4px 15px rgba(0,0,0,0.15);
    }

    .gg-hero-scope .btn-primary:hover {
      background: var(--gg-hero-green-mid);
      color: var(--gg-hero-white);
    }

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
    }

    /* ══════════════════════════════════════════
       STATS
       Desktop  → single row, 4 columns
       ≤ 860px  → 2 × 2 grid, perfectly aligned
       ≤ 480px  → 2 × 2 grid, tighter
    ══════════════════════════════════════════ */
    .gg-hero-scope .hero-stats {
      position: relative;
      width: 100%;
      max-width: 1400px; /* Expanded from 1240px */
      margin: 0 auto;
      padding: 0 var(--gg-hero-h-pad) clamp(32px, 5vh, 60px);
      z-index: 10;
      opacity: 0;
      animation: gg-hero-reveal 1.2s cubic-bezier(0.19, 1, 0.22, 1) 1.3s forwards;

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
      font-family: var(--gg-hero-font-body);
      font-size: clamp(2rem, 4vw, 2.6rem);
      font-weight: 700;
      color: var(--gg-hero-white);
      line-height: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 4px;
      font-variant-numeric: tabular-nums;
    }

    .gg-hero-scope .stat-num span {
      font-size: 0.9rem; /* Slightly smaller suffix */
      font-weight: 400;
      color: var(--gg-hero-gold);
      margin-left: 3px;
    }

    .gg-hero-scope .stat-label {
      font-size: clamp(0.65rem, 0.85vw, 0.78rem);
      font-weight: 500;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--gg-hero-text-muted);
      line-height: 1.35;
    }

    @keyframes gg-hero-reveal {
      0% {
        opacity: 0;
        transform: translateY(40px) scale(0.96);
        filter: blur(12px);
      }
      100% {
        opacity: 1;
        transform: translateY(0) scale(1);
        filter: blur(0);
      }
    }

    /* ══════════════════════════════════════════
       RESPONSIVE
    ══════════════════════════════════════════ */
    @media (max-width: 1024px) {
      .gg-hero-scope { --gg-hero-h-pad: 48px; }
      .gg-hero-scope .hero-content { padding-top: 80px; }
    }

    @media (max-width: 991px) {
      .gg-hero-scope {
        justify-content: center;
        align-items: center;
      }
      .gg-hero-scope .hero-content {
        margin: 0;
        padding: 40px var(--gg-hero-h-pad);
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
      }

      .gg-hero-scope .hero-stats {
        margin-top: 40px;
        padding-top: 20px;
        border-top: 1px solid rgba(255,255,255,0.1);
      }
    }

    @media (max-width: 860px) {
      .gg-hero-scope { --gg-hero-h-pad: 40px; }
      .gg-hero-scope .hero-content { padding-top: clamp(80px, 12vh, 140px); padding-bottom: 40px; }
      
      /* Hide decorative nodes on mid-size screens */
      .gg-hero-scope .node-1,
      .gg-hero-scope .node-2,
      .gg-hero-scope .node-3,
      .gg-hero-scope .node-4,
      .gg-hero-scope .node-5,
      .gg-hero-scope .node-lines { display: none; }

      .gg-hero-scope .hero-stats {
        grid-template-columns: repeat(2, 1fr);
        padding-bottom: clamp(24px, 4vh, 48px);
      }

      .gg-hero-scope .stat-item {
        padding: 16px;
        border-left: none;
        border-top: 1px solid rgba(255,255,255,0.1);
        align-items: center;
        text-align: center;
      }

      .gg-hero-scope .stat-item:nth-child(1),
      .gg-hero-scope .stat-item:nth-child(2) { border-top: none; }
      
      .gg-hero-scope .stat-item:nth-child(even) { border-left: 1px solid rgba(255,255,255,0.1); }
    }

    @media (max-width: 640px) {
      .gg-hero-scope { --gg-hero-h-pad: 28px; }
      .gg-hero-scope .hero-content { padding-top: clamp(70px, 10vh, 100px); }
      .gg-hero-scope .hero-headline { font-size: clamp(2.2rem, 8vh, 3.2rem); margin-bottom: 16px; }
      .gg-hero-scope .hero-desc { font-size: 0.95rem; margin-bottom: 24px; line-height: 1.5; }
      .gg-hero-scope .hero-stats { padding-bottom: 24px; }
      .gg-hero-scope .stat-num { font-size: 1.8rem; }
      .gg-hero-scope .stat-label { font-size: 0.6rem; }
      
      /* Stack CTA buttons */
      .gg-hero-scope .hero-cta-group { flex-direction: row; justify-content: flex-start; gap: 12px; }
      .gg-hero-scope .btn-primary,
      .gg-hero-scope .btn-ghost { padding: 0 20px; height: 48px; font-size: 0.75rem; }
    }

    @media (max-width: 480px) {
      .gg-hero-scope { --gg-hero-h-pad: 20px; }
      .gg-hero-scope .hero-content { padding-top: 80px; padding-bottom: 20px; }
      .gg-hero-scope .hero-headline { font-size: clamp(1.8rem, 7vh, 2.4rem); }
      .gg-hero-scope .hero-desc { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; margin-bottom: 20px; }
      
      .gg-hero-scope .stat-item { padding: 12px 8px; }
      .gg-hero-scope .stat-num { font-size: 1.5rem; }
      .gg-hero-scope .stat-num span { font-size: 0.7rem; }
      
      .gg-hero-scope .hero-cta-group { gap: 8px; }
      .gg-hero-scope .btn-primary,
      .gg-hero-scope .btn-ghost { flex: 1; padding: 0 12px; font-size: 0.7rem; letter-spacing: 0.05em; }
    }

    /* Extra safety for very short screens (landscape phones etc) */
    @media (max-height: 500px) {
      .gg-hero-scope .hero-desc { display: none; }
      .gg-hero-scope .hero-content { padding-top: 60px; }
      .gg-hero-scope .hero-stats { display: none; }
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
    <div class="hero-eyebrow">
      <span class="eyebrow-line"></span>
      <span class="eyebrow-text"><?php echo t('since'); ?> 1994</span>
    </div>

    <h1 class="hero-headline">
      <?php echo t('hero_title'); ?>
    </h1>

    <p class="hero-desc">
      <?php echo t('hero_desc'); ?>
    </p>

    <div class="hero-cta-group">
      <a href="products.php" class="btn-primary">
        <span><?php echo t('explore_products'); ?></span>
        <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
      <a href="about.php" class="btn-ghost">
        <span><?php echo t('learn_more'); ?></span>
        <svg viewBox="0 0 24 24"><path d="M12 5v14M5 12h14"/></svg>
      </a>
    </div>
  </div>

  <div class="hero-stats" aria-label="Key figures">
    <div class="stat-item">
      <div class="stat-num" data-target="40"  data-suffix="%">40<span>%</span></div>
      <div class="stat-label"><?php echo t('yield_increase'); ?></div>
    </div>
    <div class="stat-item">
      <div class="stat-num" data-target="120" data-suffix="+">120<span>+</span></div>
      <div class="stat-label"><?php echo t('varieties_tested'); ?></div>
    </div>
    <div class="stat-item">
      <div class="stat-num" data-target="58"  data-suffix="K">58<span>K</span></div>
      <div class="stat-label"><?php echo t('hectares_improved'); ?></div>
    </div>
    <div class="stat-item">
      <div class="stat-num" data-target="99"  data-suffix="%">99<span>%</span></div>
      <div class="stat-label"><?php echo t('safety_rating'); ?></div>
    </div>
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