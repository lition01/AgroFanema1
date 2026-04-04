<?php // Benefits Section — AgroFanema ?>

<section class="gg-ben-scope" id="benefits" aria-label="Përfitimet e AgroFanema">
<style>
  /* ══════════════════════════════════════════════════════════
     BENEFITS SECTION (Scoped)
     Deep Green Theme with Horizontal Bar Layout
  ══════════════════════════════════════════════════════════ */

  .gg-ben-scope {
    --ben-bg:           #0D2117; /* Deep Green Section Background */
    --ben-bar:          #1A3329; /* Horizontal Bar Background */
    --ben-accent:       #C8A84B; /* Warm Gold */
    --ben-white:        #F5F2EA; /* Panna */
    --ben-text-muted:   rgba(245, 242, 234, 0.65);
    --ben-font-display: 'Cormorant Garamond', Georgia, serif;
    --ben-font-body:    'Outfit', sans-serif;
    --ben-ease:         cubic-bezier(0.4, 0, 0.2, 1);
    --ben-h-pad:        48px;
  }

  .gg-ben-scope *,
  .gg-ben-scope *::before,
  .gg-ben-scope *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  .gg-ben-scope {
    position: relative;
    width: 100%;
    background: var(--ben-bg);
    font-family: var(--ben-font-body);
    color: var(--ben-white);
    overflow: hidden;
    padding: clamp(80px, 10vw, 120px) 0;
  }

  .gg-ben-scope .ben-inner {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 var(--ben-h-pad);
  }

  /* ══════════════════════════════════════════
     HEADER
  ══════════════════════════════════════════ */
  .gg-ben-scope .ben-header {
    text-align: center;
    max-width: 800px;
    margin: 0 auto clamp(48px, 6vw, 64px);
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.8s var(--ben-ease);
  }

  .gg-ben-scope.ben-visible .ben-header {
    opacity: 1;
    transform: translateY(0);
  }

  .gg-ben-scope .ben-headline {
    font-family: var(--ben-font-display);
    font-size: clamp(2.5rem, 4.5vw, 3.8rem);
    font-weight: 700;
    line-height: 1.1;
    color: var(--ben-accent); /* Updated to Yellow/Gold */
    margin-bottom: 16px;
    letter-spacing: -0.02em; /* Tighter for modern look */
  }

  .gg-ben-scope .ben-subline {
    font-size: 1.05rem;
    font-weight: 400;
    color: var(--ben-text-muted);
    letter-spacing: 0.01em;
  }

  /* ══════════════════════════════════════════
     HORIZONTAL BAR & GRID
  ══════════════════════════════════════════ */
  .gg-ben-scope .ben-container {
    position: relative;
    width: 100%;
    margin-top: 40px;
  }

  /* Full-width bar behind the icons */
  .gg-ben-scope .ben-bar {
    position: absolute;
    top: 50px; /* Aligns with icons */
    left: -100vw;
    right: -100vw;
    height: 100px;
    background: var(--ben-bar);
    z-index: 0;
    opacity: 0;
    transition: opacity 1s var(--ben-ease);
  }

  .gg-ben-scope.ben-visible .ben-bar { opacity: 1; }

  .gg-ben-scope .ben-grid {
    position: relative;
    z-index: 1;
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0;
  }

  /* ── Benefit Item ── */
  .gg-ben-scope .ben-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.8s var(--ben-ease);
  }

  .gg-ben-scope.ben-visible .ben-item {
    opacity: 1;
    transform: translateY(0);
  }

  /* ── Icon Circle ── */
  .gg-ben-scope .ben-icon-circle {
    width: 100px;
    height: 100px;
    background: var(--ben-white);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 40px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
    transition: transform 0.4s var(--ben-ease), box-shadow 0.4s var(--ben-ease);
  }

  .gg-ben-scope .ben-item:hover .ben-icon-circle {
    transform: scale(1.08);
    box-shadow: 0 12px 40px rgba(200, 168, 75, 0.15);
  }

  .gg-ben-scope .ben-icon-circle svg {
    width: 38px;
    height: 38px;
    stroke: var(--ben-bar);
    stroke-width: 1.8;
    fill: none;
    transition: stroke 0.3s var(--ben-ease);
  }

  .gg-ben-scope .ben-item:hover .ben-icon-circle svg {
    stroke: var(--ben-accent);
  }

  /* ── Content ── */
  .gg-ben-scope .ben-title {
    font-size: 1.35rem;
    font-weight: 700;
    color: var(--ben-white);
    margin-bottom: 16px;
    letter-spacing: -0.01em;
  }

  .gg-ben-scope .ben-desc {
    font-size: 0.95rem;
    line-height: 1.6;
    color: var(--ben-text-muted);
    max-width: 220px;
    margin-bottom: 32px;
  }

  /* ── Downward Arrow ── */
  .gg-ben-scope .ben-arrow {
    width: 0;
    height: 0;
    border-left: 8px solid transparent;
    border-right: 8px solid transparent;
    border-top: 10px solid var(--ben-accent);
    opacity: 0.6;
    transition: transform 0.3s var(--ben-ease), opacity 0.3s var(--ben-ease);
  }

  .gg-ben-scope .ben-item:hover .ben-arrow {
    transform: translateY(6px);
    opacity: 1;
  }

  /* ══════════════════════════════════════════
     RESPONSIVE
  ══════════════════════════════════════════ */
  @media (max-width: 1024px) {
    .gg-ben-scope .ben-grid { grid-template-columns: repeat(2, 1fr); gap: 60px 0; }
    .gg-ben-scope .ben-bar { display: none; } /* Hide bar on mobile grid */
    .gg-ben-scope .ben-item { padding: 0 20px; }
    .gg-ben-scope .ben-icon-circle { background: var(--ben-bar); }
    .gg-ben-scope .ben-icon-circle svg { stroke: var(--ben-white); }
  }

  @media (max-width: 640px) {
    .gg-ben-scope .ben-grid { grid-template-columns: 1fr; }
    .gg-ben-scope .ben-header { text-align: center; }
    .gg-ben-scope .ben-title { font-size: 1.25rem; }
    .gg-ben-scope .ben-desc { max-width: 100%; }
  }
</style>

  <div class="ben-inner">
    <div class="ben-header">
      <span class="ben-eyebrow"><?php echo t('benefits'); ?></span>
      <h2 class="ben-title"><?php echo t('why_choose'); ?> <em>AgroFanema</em>?</h2>
    </div>

    <div class="ben-container">
      <!-- Horizontal background bar -->
      <div class="ben-bar"></div>

      <div class="ben-grid">
        <!-- 1. Increase Yield -->
        <div class="ben-item" style="transition-delay: 0.1s;">
          <div class="ben-icon-circle">
            <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="22 7 13.5 15.5 8.5 10.5 2 17"></polyline>
              <polyline points="16 7 22 7 22 13"></polyline>
            </svg>
          </div>
          <h3 class="ben-title"><?php echo t('increase_yield'); ?></h3>
          <p class="ben-desc">
            <?php echo t('yield_desc'); ?>
          </p>
          <div class="ben-arrow"></div>
        </div>

        <!-- 2. Soil Health -->
        <div class="ben-item" style="transition-delay: 0.2s;">
          <div class="ben-icon-circle">
            <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
            </svg>
          </div>
          <h3 class="ben-title"><?php echo t('soil_health'); ?></h3>
          <p class="ben-desc">
            <?php echo t('soil_health_desc'); ?>
          </p>
          <div class="ben-arrow"></div>
        </div>

        <!-- 3. Fast Absorption -->
        <div class="ben-item" style="transition-delay: 0.3s;">
          <div class="ben-icon-circle">
            <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
              <path d="M13 2L3 14h9l-1 8 10-12h-9l1-8z"></path>
            </svg>
          </div>
          <h3 class="ben-title"><?php echo t('fast_absorption'); ?></h3>
          <p class="ben-desc">
            <?php echo t('absorption_desc'); ?>
          </p>
          <div class="ben-arrow"></div>
        </div>

        <!-- 4. Eco-Friendly -->
        <div class="ben-item" style="transition-delay: 0.4s;">
          <div class="ben-icon-circle">
            <svg viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
              <path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8a7 7 0 0 1-10 10z"></path>
              <path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"></path>
            </svg>
          </div>
          <h3 class="ben-title"><?php echo t('eco_friendly'); ?></h3>
          <p class="ben-desc">
            <?php echo t('eco_desc'); ?>
          </p>
          <div class="ben-arrow"></div>
        </div>
      </div>
    </div>
  </div>

  <script>
    (function() {
      const scope = document.querySelector('.gg-ben-scope');
      if (!scope) return;

      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entry.isIntersecting) {
            scope.classList.add('ben-visible');
            observer.disconnect();
          }
        });
      }, { threshold: 0.15 });

      observer.observe(scope);
    })();
  </script>
</section>
