<?php // Products Hero Section — GreenGrow Fertilizers ?>

<section class="gg-p-hero-scope" aria-label="Products Hero">
<style>
  /* ══════════════════════════════════════════════════════════
     PRODUCTS HERO SECTION (Scoped)
     Panna (Cream) Theme with Deep Green Accents
  ══════════════════════════════════════════════════════════ */

  .gg-p-hero-scope {
    --ph-bg:            #F5F2EA; /* Panna (Cream) */
    --ph-primary:       #1A3329; /* Deep Green */
    --ph-accent:        #C8A84B; /* Warm Gold */
    --ph-text:          #1A1A1A;
    --ph-text-muted:    #6B6B62;
    --ph-font-display:  'Cormorant Garamond', Georgia, serif;
    --ph-font-body:     'Outfit', sans-serif;
    --ph-ease:          cubic-bezier(0.4, 0, 0.2, 1);
    --ph-h-pad:         48px;

    position: relative;
    width: 100%;
    background: var(--ph-bg);
    font-family: var(--ph-font-body);
    color: var(--ph-text);
    overflow: hidden;
    padding: clamp(140px, 15vw, 180px) 0 80px; /* Offset for navbar */
  }

  .gg-p-hero-scope *,
  .gg-p-hero-scope *::before,
  .gg-p-hero-scope *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  .gg-p-hero-scope .ph-inner {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 var(--ph-h-pad);
    text-align: center;
  }

  /* ── Header ────────────────────────────────────────────── */
  .gg-p-hero-scope .ph-header {
    max-width: 800px;
    margin: 0 auto;
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.8s var(--ph-ease);
  }

  .gg-p-hero-scope.ph-visible .ph-header { opacity: 1; transform: translateY(0); }

  .gg-p-hero-scope .ph-eyebrow {
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.2em;
    color: var(--ph-accent);
    margin-bottom: 24px;
    display: block;
  }

  .gg-p-hero-scope .ph-headline {
    font-family: var(--ph-font-display);
    font-size: clamp(3rem, 6vw, 5rem);
    font-weight: 700;
    line-height: 1.1;
    color: var(--ph-primary);
    margin-bottom: 32px;
  }

  .gg-p-hero-scope .ph-headline em {
    font-style: italic;
    color: var(--ph-accent);
  }

  .gg-p-hero-scope .ph-subline {
    font-size: clamp(1.1rem, 1.5vw, 1.3rem);
    line-height: 1.6;
    color: var(--ph-text-muted);
    max-width: 640px;
    margin: 0 auto;
  }

  /* ── Decorative Elements ────────────────────────────────── */
  .gg-p-hero-scope::before {
    content: '';
    position: absolute;
    top: 0; left: 0; width: 100%; height: 100%;
    background: 
      radial-gradient(circle at 10% 10%, rgba(26, 51, 41, 0.03) 0%, transparent 40%),
      radial-gradient(circle at 90% 90%, rgba(200, 168, 75, 0.03) 0%, transparent 40%);
    pointer-events: none;
  }

  /* ── Responsive ── */
  @media (max-width: 768px) {
    .gg-p-hero-scope { --ph-h-pad: 24px; }
  }
</style>

  <div class="ph-inner">
    <header class="ph-header">
      <span class="ph-eyebrow">Professional Selection</span>
      <h1 class="ph-headline">Nourishing the <em>Future</em> of Farming</h1>
      <p class="ph-subline">
        Explore our complete catalog of organic fertilizers, engineered to restore soil vitality and maximize your harvest.
      </p>
    </header>
  </div>

  <script>
    (function() {
      const scope = document.querySelector('.gg-p-hero-scope');
      if (!scope) return;
      setTimeout(() => {
        scope.classList.add('ph-visible');
      }, 100);
    })();
  </script>
</section>