<?php // FAQ Section — AgroFanema ?>

<section class="gg-faq-scope" id="faq" aria-label="Pyetje të Shpeshta - AgroFanema">
<style>
  .gg-faq-scope {
    --fq-bg:           #F5F2EA;
    --fq-primary:      #1A3329;
    --fq-accent:       #C8A84B;
    --fq-text:         #1A1A1A;
    --fq-text-muted:   #6B6B62;
    --fq-border:       #E2E0DA;
    --fq-font-display: 'Cormorant Garamond', Georgia, serif;
    --fq-font-body:    'Outfit', sans-serif;
    --fq-spring:       cubic-bezier(0.22, 1, 0.36, 1);
    --fq-ease:         cubic-bezier(0.4, 0, 0.2, 1);

    background: var(--fq-bg);
    color: var(--fq-text);
    font-family: var(--fq-font-body);
    padding: clamp(60px, 8vw, 100px) 0; /* Reduced padding */
    position: relative;
    overflow: hidden;
  }

  .gg-faq-scope *, .gg-faq-scope *::before, .gg-faq-scope *::after {
    box-sizing: border-box; margin: 0; padding: 0;
  }

  /* ── subtle dot-grid background ── */
  .gg-faq-scope::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(26,51,41,0.07) 1px, transparent 1px);
    background-size: 28px 28px;
    pointer-events: none;
    opacity: 0.5;
  }

  .fq-inner {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 48px;
    position: relative;
    z-index: 1;
  }

  /* ══════════════════════════════
     HEADER
  ══════════════════════════════ */
  .fq-header {
    text-align: center;
    max-width: 640px;
    margin: 0 auto 80px;
    /* staggered entrance */
  }

  .fq-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    font-size: 0.68rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.22em;
    color: var(--fq-accent);
    margin-bottom: 20px;
    opacity: 0;
    transform: translateY(16px);
    animation: fq-rise 0.7s var(--fq-spring) 0.1s forwards;
  }
  .fq-eyebrow::before,
  .fq-eyebrow::after {
    content: '';
    width: 28px;
    height: 1px;
    background: var(--fq-accent);
    opacity: 0.5;
  }

  .fq-title {
    font-family: var(--fq-font-display);
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 700;
    line-height: 1.1;
    color: var(--fq-primary);
    margin-bottom: 20px;
    opacity: 0;
    transform: translateY(20px);
    animation: fq-rise 0.8s var(--fq-spring) 0.2s forwards;
  }
  .fq-title em { font-style: italic; color: var(--fq-accent); }

  .fq-sub {
    font-size: 1rem;
    line-height: 1.7;
    color: var(--fq-text-muted);
    opacity: 0;
    transform: translateY(16px);
    animation: fq-rise 0.8s var(--fq-spring) 0.32s forwards;
  }

  /* ══════════════════════════════
     GRID
  ══════════════════════════════ */
  .fq-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0 60px;
  }
  .fq-col { display: flex; flex-direction: column; }

  /* ══════════════════════════════
     ACCORDION ITEMS
  ══════════════════════════════ */
  .fq-item {
    border-bottom: 1px solid var(--fq-border);
    opacity: 0;
    transform: translateY(22px);
    /* JS will trigger animation via .fq-anim class */
    transition: opacity 0.6s var(--fq-spring), transform 0.6s var(--fq-spring);
  }
  .fq-item.fq-anim {
    opacity: 1;
    transform: translateY(0);
  }

  .fq-question {
    width: 100%;
    background: none;
    border: none;
    padding: 28px 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 24px;
    cursor: pointer;
    text-align: left;
  }

  .fq-q-text {
    font-family: var(--fq-font-body);
    font-size: 1rem;
    font-weight: 600;
    color: var(--fq-primary);
    line-height: 1.45;
    transition: color 0.25s var(--fq-ease);
  }

  /* ── icon: circle that morphs ── */
  .fq-icon {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: transparent;
    border: 1.5px solid var(--fq-border);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    position: relative;
    overflow: hidden;
    transition:
      border-color  0.3s var(--fq-ease),
      background    0.35s var(--fq-ease),
      transform     0.35s var(--fq-spring);
  }

  /* fill sweep on open */
  .fq-icon::before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: 50%;
    background: var(--fq-primary);
    transform: scale(0);
    transition: transform 0.35s var(--fq-spring);
  }

  .fq-icon svg {
    width: 12px; height: 12px;
    stroke: var(--fq-primary);
    fill: none;
    stroke-width: 2.5;
    stroke-linecap: round;
    stroke-linejoin: round;
    position: relative;
    z-index: 1;
    transition: transform 0.4s var(--fq-spring), stroke 0.3s;
  }

  /* hover */
  .fq-item:hover .fq-q-text { color: var(--fq-accent); }
  .fq-item:hover .fq-icon { border-color: var(--fq-accent); }

  /* open */
  .fq-item.open .fq-q-text { color: var(--fq-accent); }
  .fq-item.open .fq-icon {
    border-color: var(--fq-primary);
    transform: rotate(45deg);
  }
  .fq-item.open .fq-icon::before { transform: scale(1); }
  .fq-item.open .fq-icon svg { stroke: #fff; }

  /* ── answer panel ── */
  .fq-answer {
    display: grid;
    grid-template-rows: 0fr;
    transition: grid-template-rows 0.45s var(--fq-spring);
  }
  .fq-item.open .fq-answer {
    grid-template-rows: 1fr;
  }
  .fq-answer-clip {
    overflow: hidden;
  }
  .fq-answer-inner {
    padding: 0 0 28px;
    font-size: 0.95rem;
    line-height: 1.75;
    color: var(--fq-text-muted);
    /* fade in when open */
    opacity: 0;
    transform: translateY(6px);
    transition: opacity 0.35s var(--fq-ease) 0.1s, transform 0.35s var(--fq-spring) 0.1s;
  }
  .fq-item.open .fq-answer-inner {
    opacity: 1;
    transform: translateY(0);
  }
  .fq-answer-inner a {
    color: var(--fq-accent);
    text-decoration: none;
    font-weight: 500;
    border-bottom: 1px solid rgba(200,168,75,0.3);
    transition: border-color 0.2s;
  }
  .fq-answer-inner a:hover { border-color: var(--fq-accent); }

  /* ── keyframes ── */
  @keyframes fq-rise {
    to { opacity: 1; transform: translateY(0); }
  }

  /* ── responsive ── */
  @media (max-width: 860px) {
    .fq-grid { grid-template-columns: 1fr; gap: 0; }
    .fq-inner { padding: 0 32px; }
    .fq-header { margin-bottom: 48px; }
  }
  @media (max-width: 520px) {
    .fq-inner { padding: 0 20px; }
    .fq-q-text { font-size: 0.95rem; }
  }
</style>

  <div class="fq-inner">

    <header class="fq-header">
      <span class="fq-eyebrow"><?php echo t('support_center'); ?></span>
      <h2 class="fq-title"><?php echo t('faq'); ?></h2>
      <p class="fq-sub"><?php echo t('faq_sub'); ?></p>
    </header>

    <div class="fq-grid">

      <!-- Column 1 -->
      <div class="fq-col">
        <div class="fq-item">
          <button class="fq-question" aria-expanded="false">
            <span class="fq-q-text">What makes GreenGrow fertilizers different from synthetic options?</span>
            <span class="fq-icon"><svg viewBox="0 0 12 12"><path d="M6 1v10M1 6h10"/></svg></span>
          </button>
          <div class="fq-answer"><div class="fq-answer-clip"><div class="fq-answer-inner">
            Unlike synthetic fertilizers that deliver a fast nutrient spike and deplete soil over time, GreenGrow products are made from 100% organic matter — compost, kelp, bone meal, and worm castings. They feed your plants slowly and consistently while improving soil structure and microbial activity.
          </div></div></div>
        </div>

        <div class="fq-item">
          <button class="fq-question" aria-expanded="false">
            <span class="fq-q-text">Are your products safe for vegetables and edible plants?</span>
            <span class="fq-icon"><svg viewBox="0 0 12 12"><path d="M6 1v10M1 6h10"/></svg></span>
          </button>
          <div class="fq-answer"><div class="fq-answer-clip"><div class="fq-answer-inner">
            Absolutely. All GreenGrow products are USDA Certified Organic and Non-GMO Verified, which means they're safe for use on vegetables, fruits, herbs, and any edible crops. We recommend following the application rates on each product label for best results.
          </div></div></div>
        </div>

        <div class="fq-item">
          <button class="fq-question" aria-expanded="false">
            <span class="fq-q-text">How often should I apply the fertilizer?</span>
            <span class="fq-icon"><svg viewBox="0 0 12 12"><path d="M6 1v10M1 6h10"/></svg></span>
          </button>
          <div class="fq-answer"><div class="fq-answer-clip"><div class="fq-answer-inner">
            Application frequency depends on the product and plant type. As a general guide, our granular formulas are applied every 4–6 weeks during the growing season, while liquid concentrates can be used bi-weekly.
          </div></div></div>
        </div>
      </div>

      <!-- Column 2 -->
      <div class="fq-col">
        <div class="fq-item">
          <button class="fq-question" aria-expanded="false">
            <span class="fq-q-text">Do you ship internationally?</span>
            <span class="fq-icon"><svg viewBox="0 0 12 12"><path d="M6 1v10M1 6h10"/></svg></span>
          </button>
          <div class="fq-answer"><div class="fq-answer-clip"><div class="fq-answer-inner">
            Yes — we ship to over 40 countries. International shipping rates and delivery times vary by destination and are calculated at checkout. Please note that some countries have import restrictions on organic soil amendments.
          </div></div></div>
        </div>

        <div class="fq-item">
          <button class="fq-question" aria-expanded="false">
            <span class="fq-q-text">Can I use GreenGrow products in combination?</span>
            <span class="fq-icon"><svg viewBox="0 0 12 12"><path d="M6 1v10M1 6h10"/></svg></span>
          </button>
          <div class="fq-answer"><div class="fq-answer-clip"><div class="fq-answer-inner">
            Yes — our product line is designed to work together. For example, pairing our All-Purpose Granular with the Liquid Kelp Boost gives you both slow-release foundational nutrition and a fast-acting micronutrient lift.
          </div></div></div>
        </div>

        <div class="fq-item">
          <button class="fq-question" aria-expanded="false">
            <span class="fq-q-text">What is your return policy?</span>
            <span class="fq-icon"><svg viewBox="0 0 12 12"><path d="M6 1v10M1 6h10"/></svg></span>
          </button>
          <div class="fq-answer"><div class="fq-answer-clip"><div class="fq-answer-inner">
            We offer a 30-day satisfaction guarantee on all products. If you're not happy with your purchase for any reason, contact us at <a href="mailto:hello@greengrow.com">hello@greengrow.com</a> and we'll arrange a full refund or replacement.
          </div></div></div>
        </div>
      </div>

    </div>
  </div>

  <script>
  (function () {
    const scope = document.querySelector('.gg-faq-scope');
    if (!scope) return;

    /* ── Staggered entrance for items ── */
    const items = scope.querySelectorAll('.fq-item');
    const io = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (!entry.isIntersecting) return;
        const item = entry.target;
        const idx = [...items].indexOf(item);
        // left col: 0,1,2 → delays 0, 0.1, 0.2
        // right col: 3,4,5 → delays 0.05, 0.15, 0.25 (offset so cols interleave)
        const col  = idx < 3 ? 0 : 1;
        const row  = idx < 3 ? idx : idx - 3;
        const delay = row * 0.12 + col * 0.06;
        item.style.transitionDelay = delay + 's';
        item.classList.add('fq-anim');
        io.unobserve(item);
      });
    }, { threshold: 0.15 });

    items.forEach(item => io.observe(item));

    /* ── Accordion ── */
    scope.querySelectorAll('.fq-question').forEach(btn => {
      btn.addEventListener('click', () => {
        const item   = btn.closest('.fq-item');
        const isOpen = item.classList.contains('open');

        // toggle clicked
        item.classList.toggle('open', !isOpen);
        btn.setAttribute('aria-expanded', String(!isOpen));
      });
    });
  })();
</script>
</section>