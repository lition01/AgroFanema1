<?php // Best Seller Products Section — AgroFanema ?>

<section class="gg-section-v3" id="gg-section-v3" aria-label="AgroFanema Featured Collection">
  <style>
    .gg-section-v3 {
      --bg:            #0D2117; /* Deep Green Background */
      --accent:        #C8A84B;
      --text-bright:   #F5F2EA;
      --text-muted:    rgba(245, 242, 234, 0.7);
      --ease-out:      cubic-bezier(0.19, 1, 0.22, 1);
      
      font-family: 'Outfit', sans-serif;
      background: var(--bg);
      color: var(--text-bright);
      padding: clamp(80px, 12vw, 160px) 0;
      position: relative;
      overflow: hidden;
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
    }

    /* ── Background Decoration ────────────────── */
    .gg-section-v3 .bg-glow {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 80vw;
      height: 80vw;
      background: radial-gradient(circle, rgba(200, 168, 75, 0.05) 0%, transparent 70%);
      pointer-events: none;
      z-index: 1;
    }

    .gg-section-v3 .inner {
      width: 100%;
      max-width: 1000px;
      padding: 0 24px;
      position: relative;
      z-index: 10;
    }

    /* ── Typography ───────────────────────────── */
    .gg-section-v3 .intro-label {
      display: inline-block;
      font-size: 0.8rem;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.3em;
      color: var(--accent);
      margin-bottom: 24px;
      opacity: 0;
      transform: translateY(20px);
      transition: all 0.8s var(--ease-out);
    }

    .gg-section-v3 .headline {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(2.8rem, 7vw, 5.5rem);
      font-weight: 500;
      line-height: 1;
      margin-bottom: 40px;
      letter-spacing: -0.02em;
      opacity: 0;
      transform: translateY(30px);
      transition: all 1s var(--ease-out) 0.2s;
    }

    .gg-section-v3 .headline span {
      display: block;
      color: var(--accent);
      font-style: italic;
    }

    .gg-section-v3 .description {
      font-size: clamp(1.1rem, 2vw, 1.3rem);
      color: var(--text-muted);
      line-height: 1.6;
      max-width: 700px;
      margin: 0 auto 60px;
      font-weight: 300;
      opacity: 0;
      transform: translateY(20px);
      transition: all 0.8s var(--ease-out) 0.4s;
    }

    /* ── Action Area ─────────────────────────── */
    .gg-section-v3 .action-area {
      display: flex;
      justify-content: center;
      align-items: center;
      gap: 32px;
      opacity: 0;
      transform: translateY(20px);
      transition: all 0.8s var(--ease-out) 0.6s;
    }

    .gg-section-v3 .btn-primary {
      padding: 18px 48px;
      background: var(--accent);
      color: var(--bg);
      border-radius: 100px;
      text-decoration: none;
      font-weight: 600;
      font-size: 1rem;
      transition: all 0.4s var(--ease-out);
      box-shadow: 0 10px 30px rgba(200, 168, 75, 0.2);
    }

    .gg-section-v3 .btn-primary:hover {
      transform: scale(1.05) translateY(-2px);
      box-shadow: 0 15px 40px rgba(200, 168, 75, 0.3);
      background: #E0BD54;
    }

    .gg-section-v3 .btn-outline {
      color: var(--text-bright);
      text-decoration: none;
      font-weight: 500;
      font-size: 1rem;
      display: flex;
      align-items: center;
      gap: 10px;
      transition: all 0.3s ease;
      padding: 10px 0;
      border-bottom: 1px solid rgba(245, 242, 234, 0.2);
    }

    .gg-section-v3 .btn-outline:hover {
      border-color: var(--accent);
      color: var(--accent);
    }

    /* ── Animations ──────────────────────────── */
    .gg-section-v3.visible .intro-label,
    .gg-section-v3.visible .headline,
    .gg-section-v3.visible .description,
    .gg-section-v3.visible .action-area {
      opacity: 1;
      transform: translateY(0);
    }

    /* ── Responsive ──────────────────────────── */
    @media (max-width: 768px) {
      .gg-section-v3 { padding: 100px 24px; }
      .gg-section-v3 .action-area { flex-direction: column; gap: 24px; }
      .gg-section-v3 .btn-primary { width: 100%; text-align: center; }
    }
  </style>

  <div class="bg-glow"></div>

  <div class="inner">
    <span class="intro-label">Premium Organic Solutions</span>
    
    <h2 class="headline">
      Elevate your harvest 
      <span>with our curated selection.</span>
    </h2>

    <p class="description">
      Unlock the full potential of your crops with fertilizers designed for the modern farmer. 
      Sustainable, efficient, and naturally powerful.
    </p>

    <div class="action-area">
      <a href="products.php" class="btn-primary">Explore Collection</a>
      <a href="contact.php" class="btn-outline">
        Connect with us
        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
      </a>
    </div>
  </div>

  <script>
    (function() {
      const section = document.querySelector('#gg-section-v3');
      const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
          if (entries[0].isIntersecting) {
            section.classList.add('visible');
          }
        });
      }, { threshold: 0.2 });
      observer.observe(section);
    })();
  </script>
</section>
