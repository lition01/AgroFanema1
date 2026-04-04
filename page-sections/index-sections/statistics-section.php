<section class="gg-stats" id="gg-stats" aria-label="Our Impact Statistics">
  <style>
    .gg-stats {
      /* Premium Color Palette */
      --onyx:        #0A0F0D;
      --forest:      #0D1F16;
      --emerald:     #1A3D2B;
      --sage:        #2D5A42;
      --malachite:   #3B7355;
      --champagne:   #D4AF37;
      --gold:        #C9A227;
      --antique:     #B8976E;
      --cream:       #FAF8F5;
      --ivory:       #F7F5F0;
      --pearl:       #EBE8E2;
      --stone:       #D5D0C8;
      --text-primary:#1A1F1C;
      --text-secondary:#4A524D;
      --text-tertiary:#7A847D;

      /* Animation Curves */
      --ease-luxe:   cubic-bezier(0.19, 1, 0.22, 1);
      --ease-smooth: cubic-bezier(0.4, 0, 0.2, 1);
      --ease-bounce: cubic-bezier(0.34, 1.56, 0.64, 1);

      font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
      background: linear-gradient(180deg, var(--ivory) 0%, var(--cream) 100%);
      position: relative;
      overflow: hidden;
      width: 100%;
    }

    /* Subtle texture overlay */
    .gg-stats::before {
      content: '';
      position: absolute;
      inset: 0;
      background:
        radial-gradient(ellipse 80% 50% at 20% 0%, rgba(59, 115, 85, 0.03) 0%, transparent 60%),
        radial-gradient(ellipse 60% 40% at 80% 100%, rgba(201, 162, 39, 0.025) 0%, transparent 50%),
        radial-gradient(circle at 50% 50%, rgba(26, 61, 43, 0.01) 0%, transparent 80%);
      pointer-events: none;
      z-index: 0;
    }

    .st-inner {
      position: relative;
      z-index: 1;
      max-width: 1400px; /* Expanded from 1200px */
      margin: 0 auto;
      padding: clamp(80px, 10vw, 140px) clamp(24px, 5vw, 80px);
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: clamp(72px, 8vw, 110px);
    }

    /* Header Section */
    .st-header {
      text-align: center;
      max-width: 680px;
    }

    .st-eyebrow {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 24px;
      margin-bottom: 32px;
      opacity: 0;
      transform: translateY(24px);
      transition: all 1s var(--ease-luxe);
    }

    .gg-stats.visible .st-eyebrow {
      opacity: 1;
      transform: translateY(0);
    }

    .st-eyebrow-line {
      width: 56px;
      height: 1px;
      position: relative;
      overflow: hidden;
    }

    .st-eyebrow-line::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(90deg, transparent, var(--champagne));
      transform: translateX(-100%);
      transition: transform 1.2s var(--ease-luxe) 0.3s;
    }

    .st-eyebrow-line:last-child::before {
      background: linear-gradient(90deg, var(--champagne), transparent);
      transform: translateX(100%);
    }

    .gg-stats.visible .st-eyebrow-line::before {
      transform: translateX(0);
    }

    .st-eyebrow-text {
      font-size: 0.65rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.35em;
      color: var(--champagne);
    }

    .st-headline {
      font-family: 'Cormorant Garamond', Georgia, serif;
      font-size: clamp(2.5rem, 5vw, 3.75rem);
      font-weight: 500;
      color: var(--forest);
      line-height: 1.1;
      margin-bottom: 28px;
      letter-spacing: -0.02em;
      opacity: 0;
      transform: translateY(36px);
      transition: all 1s var(--ease-luxe) 0.15s;
    }

    .gg-stats.visible .st-headline {
      opacity: 1;
      transform: translateY(0);
    }

    .st-headline em {
      font-style: italic;
      color: var(--sage);
    }

    .st-subline {
      font-size: 0.95rem;
      color: var(--text-secondary);
      line-height: 1.8;
      font-weight: 400;
      max-width: 520px;
      margin: 0 auto;
      opacity: 0;
      transform: translateY(36px);
      transition: all 1s var(--ease-luxe) 0.25s;
    }

    .gg-stats.visible .st-subline {
      opacity: 1;
      transform: translateY(0);
    }

    /* Stats Container */
    .st-stats-container {
      width: 100%;
      position: relative;
    }

    /* Horizontal decorative lines */
    .st-line-top,
    .st-line-bottom {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
      height: 1px;
      width: 0;
      transition: width 1.4s var(--ease-luxe) 0.4s;
    }

    .st-line-top {
      top: 0;
      background: linear-gradient(90deg, 
        transparent 0%, 
        var(--stone) 10%,
        var(--champagne) 30%,
        var(--gold) 50%,
        var(--champagne) 70%,
        var(--stone) 90%,
        transparent 100%
      );
    }

    .st-line-bottom {
      bottom: 0;
      background: linear-gradient(90deg, 
        transparent 0%, 
        var(--stone) 15%,
        var(--antique) 40%,
        var(--champagne) 50%,
        var(--antique) 60%,
        var(--stone) 85%,
        transparent 100%
      );
    }

    .gg-stats.visible .st-line-top,
    .gg-stats.visible .st-line-bottom {
      width: 100%;
    }

    /* Diamond ornament */
    .st-ornament {
      position: absolute;
      top: -4px;
      left: 50%;
      transform: translateX(-50%) rotate(45deg) scale(0);
      width: 8px;
      height: 8px;
      background: var(--champagne);
      opacity: 0;
      transition: all 0.8s var(--ease-bounce) 1s;
    }

    .gg-stats.visible .st-ornament {
      opacity: 1;
      transform: translateX(-50%) rotate(45deg) scale(1);
    }

    /* Stats Row */
    .st-stats-row {
      width: 100%;
      display: flex;
      align-items: stretch;
      justify-content: center;
      padding: 48px 0;
    }

    .st-stat {
      flex: 1;
      max-width: 260px;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      padding: 32px 20px;
      position: relative;
      opacity: 0;
      transform: translateY(50px);
      transition: all 1s var(--ease-luxe);
    }

    .gg-stats.visible .st-stat {
      opacity: 1;
      transform: translateY(0);
    }

    .gg-stats.visible .st-stat:nth-child(1) { transition-delay: 0.5s; }
    .gg-stats.visible .st-stat:nth-child(3) { transition-delay: 0.65s; }
    .gg-stats.visible .st-stat:nth-child(5) { transition-delay: 0.8s; }
    .gg-stats.visible .st-stat:nth-child(7) { transition-delay: 0.95s; }

    /* Sophisticated Vertical Dividers */
    .st-divider {
      width: 1px;
      align-self: stretch;
      position: relative;
      margin: 16px 0;
    }

    .st-divider::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 0;
      background: linear-gradient(180deg, 
        transparent 0%,
        var(--stone) 8%,
        var(--antique) 25%,
        var(--champagne) 50%,
        var(--antique) 75%,
        var(--stone) 92%,
        transparent 100%
      );
      transition: height 1.2s var(--ease-luxe);
    }

    .gg-stats.visible .st-divider::before {
      height: 100%;
    }

    .gg-stats.visible .st-divider:nth-child(2)::before { transition-delay: 0.6s; }
    .gg-stats.visible .st-divider:nth-child(4)::before { transition-delay: 0.75s; }
    .gg-stats.visible .st-divider:nth-child(6)::before { transition-delay: 0.9s; }

    /* Divider center dot */
    .st-divider::after {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 5px;
      height: 5px;
      background: var(--champagne);
      border-radius: 50%;
      transform: translate(-50%, -50%) scale(0);
      transition: transform 0.6s var(--ease-bounce);
      box-shadow: 0 0 8px rgba(201, 162, 39, 0.3);
    }

    .gg-stats.visible .st-divider::after {
      transform: translate(-50%, -50%) scale(1);
    }

    .gg-stats.visible .st-divider:nth-child(2)::after { transition-delay: 1.2s; }
    .gg-stats.visible .st-divider:nth-child(4)::after { transition-delay: 1.35s; }
    .gg-stats.visible .st-divider:nth-child(6)::after { transition-delay: 1.5s; }

    /* Premium Icon */
    .st-icon {
      width: 44px;
      height: 44px;
      margin-bottom: 24px;
      position: relative;
    }

    .st-icon svg {
      width: 100%;
      height: 100%;
      color: var(--sage);
      transition: all 0.6s var(--ease-luxe);
    }

    .st-stat:hover .st-icon svg {
      color: var(--champagne);
      transform: translateY(-6px);
      filter: drop-shadow(0 4px 12px rgba(201, 162, 39, 0.25));
    }

    /* Number */
    .st-num-wrap {
      display: flex;
      align-items: baseline;
      justify-content: center;
      margin-bottom: 14px;
      position: relative;
    }

    .st-number {
      font-family: 'Cormorant Garamond', Georgia, serif;
      font-size: clamp(2.5rem, 3.5vw, 3.25rem);
      font-weight: 500;
      color: var(--forest);
      line-height: 1;
      letter-spacing: -0.03em;
      transition: all 0.6s var(--ease-luxe);
    }

    .st-stat:hover .st-number {
      color: var(--emerald);
      transform: scale(1.02);
    }

    .st-suffix {
      font-family: 'Cormorant Garamond', Georgia, serif;
      font-size: 0.9rem; /* Reduced from 1.25rem */
      font-weight: 600;
      color: var(--champagne);
      margin-left: 2px;
      transition: all 0.6s var(--ease-luxe);
      align-self: flex-start; /* Align to top of number */
      margin-top: 8px;
    }

    .st-stat:hover .st-suffix {
      color: var(--gold);
    }

    /* Label */
    .st-label {
      font-size: 0.65rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.25em;
      color: var(--text-tertiary);
      transition: color 0.6s var(--ease-luxe);
    }

    .st-stat:hover .st-label {
      color: var(--text-secondary);
    }

    /* Responsive */
    @media (max-width: 1024px) {
      .st-inner {
        padding: 80px 40px;
        gap: 60px;
      }
    }

    @media (max-width: 900px) {
      .st-stats-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 0;
        padding: 40px 0;
      }

      .st-stat {
        max-width: 100%;
        padding: 40px 20px;
      }

      .st-divider {
        display: none;
      }

      /* Grid lines for 2x2 */
      .st-stat:nth-child(1),
      .st-stat:nth-child(3) {
        border-right: 1px solid rgba(184, 151, 110, 0.2);
      }

      .st-stat:nth-child(1),
      .st-stat:nth-child(3) {
        border-bottom: 1px solid rgba(184, 151, 110, 0.2);
      }
      
      .st-stat:nth-child(5) {
        border-right: 1px solid rgba(184, 151, 110, 0.2);
      }
      
      /* Reset for children indices in grid */
      /* Row 1 */
      .st-stat:nth-child(1) { order: 1; }
      .st-stat:nth-child(3) { order: 2; border-right: none; }
      /* Row 2 */
      .st-stat:nth-child(5) { order: 3; border-bottom: none; }
      .st-stat:nth-child(7) { order: 4; border-bottom: none; border-right: none; }
    }

    @media (max-width: 640px) {
      .st-inner {
        padding: 60px 20px;
        gap: 48px;
      }

      .st-headline {
        font-size: 2.1rem;
      }

      .st-stats-row {
        grid-template-columns: 1fr;
        padding: 20px 0;
      }

      .st-stat {
        padding: 32px 20px;
        border-right: none !important;
        border-bottom: 1px solid rgba(184, 151, 110, 0.2) !important;
      }

      .st-stat:last-child {
        border-bottom: none !important;
      }

      .st-number {
        font-size: 2.8rem;
      }

      .st-suffix {
        font-size: 0.8rem;
        margin-top: 6px;
      }
    }
  </style>

  <div class="st-inner">
    <header class="st-header">
      <div class="st-eyebrow">
        <span class="st-eyebrow-line"></span>
        <span class="st-eyebrow-text"><?php echo t('proven_results'); ?></span>
        <span class="st-eyebrow-line"></span>
      </div>
      <h2 class="st-headline"><?php echo t('cultivating_excellence'); ?></h2>
      <p class="st-subline"><?php echo t('stats_subline'); ?></p>
    </header>

    <div class="st-stats-container">
      <div class="st-line-top"></div>
      <div class="st-ornament"></div>
      
      <div class="st-stats-row">
        <!-- Stat 1: Yield Increase -->
        <article class="st-stat">
          <div class="st-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
              <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
              <polyline points="17 6 23 6 23 12"></polyline>
            </svg>
          </div>
          <div class="st-num-wrap">
            <span class="st-number" data-target="40">0</span>
            <span class="st-suffix">%</span>
          </div>
          <span class="st-label"><?php echo t('yield_increase'); ?></span>
        </article>

        <div class="st-divider"></div>

        <!-- Stat 2: Crop Varieties Tested -->
        <article class="st-stat">
          <div class="st-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
            </svg>
          </div>
          <div class="st-num-wrap">
            <span class="st-number" data-target="120">0</span>
            <span class="st-suffix">+</span>
          </div>
          <span class="st-label"><?php echo t('varieties_tested'); ?></span>
        </article>

        <div class="st-divider"></div>

        <!-- Stat 3: Hectares Improved -->
        <article class="st-stat">
          <div class="st-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
              <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
              <polyline points="9 22 9 12 15 12 15 22"></polyline>
            </svg>
          </div>
          <div class="st-num-wrap">
            <span class="st-number" data-target="58">0</span>
            <span class="st-suffix">K</span>
          </div>
          <span class="st-label"><?php echo t('hectares_improved'); ?></span>
        </article>

        <div class="st-divider"></div>

        <!-- Stat 4: Soil Safety Rating -->
        <article class="st-stat">
          <div class="st-icon">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
              <polyline points="9 11 12 14 15 11"></polyline>
            </svg>
          </div>
          <div class="st-num-wrap">
            <span class="st-number" data-target="99">0</span>
            <span class="st-suffix">%</span>
          </div>
          <span class="st-label"><?php echo t('safety_rating'); ?></span>
        </article>
      </div>

      <div class="st-line-bottom"></div>
    </div>
  </div>

<script>
(function() {
  var section = document.getElementById('gg-stats');
  var numbers = section.querySelectorAll('.st-number');
  var hasAnimated = false;

  // Premium easing functions
  function easeOutQuart(t) {
    return 1 - Math.pow(1 - t, 4);
  }

  function easeOutExpo(t) {
    return t === 1 ? 1 : 1 - Math.pow(2, -10 * t);
  }

  // Smooth spring-like interpolation
  function easeOutElastic(t) {
    var c4 = (2 * Math.PI) / 3;
    return t === 0 ? 0 : t === 1 ? 1 : Math.pow(2, -10 * t) * Math.sin((t * 10 - 0.75) * c4) + 1;
  }

  function animateNumber(element, target, duration) {
    var startTime = null;
    var startValue = 0;

    function update(currentTime) {
      if (!startTime) startTime = currentTime;
      var elapsed = currentTime - startTime;
      var progress = Math.min(elapsed / duration, 1);
      
      // Use different easing for different number ranges
      var easedProgress = target > 1000 ? easeOutQuart(progress) : easeOutExpo(progress);
      var currentValue = Math.floor(startValue + (target - startValue) * easedProgress);
      
      element.textContent = currentValue.toLocaleString();

      if (progress < 1) {
        requestAnimationFrame(update);
      } else {
        element.textContent = target.toLocaleString();
      }
    }

    requestAnimationFrame(update);
  }

  function animateNumbers() {
    if (hasAnimated) return;
    hasAnimated = true;

    numbers.forEach(function(num, index) {
      var target = parseInt(num.getAttribute('data-target'), 10);
      // Staggered delays with longer intervals for premium feel
      var delay = 600 + (index * 200);
      // Longer duration for larger numbers
      var duration = target > 1000 ? 2800 : 2200;
      
      setTimeout(function() {
        animateNumber(num, target, duration);
      }, delay);
    });
  }

  var observer = new IntersectionObserver(function(entries) {
    if (entries[0].isIntersecting) {
      section.classList.add('visible');
      animateNumbers();
      observer.disconnect();
    }
  }, { 
    threshold: 0.2,
    rootMargin: '0px 0px -80px 0px'
  });

  observer.observe(section);
})();
</script>
</section>
