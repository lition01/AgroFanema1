<!DOCTYPE html>
<html>
<head>
<style>
  * { box-sizing: border-box; margin: 0; padding: 0; }

  .gg-section {
    --bg:            #0D2117;
    --surface:       #132D1E;
    --surface-hover: #173624;
    --accent:        #C8A84B;
    --text:          #F5F2EA;
    --muted:         rgba(245,242,234,0.55);
    --border:        rgba(245,242,234,0.08);
    --border-hover:  rgba(200,168,75,0.6);
    --ease:          cubic-bezier(0.4,0,0.2,1);
    font-family: 'Outfit', sans-serif;
    background: var(--bg);
    color: var(--text);
    padding: clamp(60px,8vw,90px) clamp(20px,4vw,48px);
    overflow: hidden;
  }

  .inner {
    max-width: 1200px;
    margin: 0 auto;
  }

  .pd-header {
    text-align: center;
    margin-bottom: 52px;
    opacity: 0;
    transform: translateY(18px);
    transition: opacity 0.6s var(--ease), transform 0.6s var(--ease);
  }

  .pd-header.visible { opacity: 1; transform: none; }

  .eyebrow {
    display: block;
    font-size: 0.65rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.16em;
    color: var(--accent);
    margin-bottom: 14px;
  }

  .headline {
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-size: clamp(2rem, 4vw, 2.8rem);
    font-weight: 700;
    line-height: 1.2;
    color: var(--text);
  }

  .pd-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
  }

  .pd-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: 14px;
    padding: 20px;
    display: flex;
    flex-direction: column;
    text-decoration: none;
    color: inherit;
    opacity: 0;
    transform: translateY(22px);
    transition: opacity 0.5s var(--ease), transform 0.5s var(--ease), border-color 0.3s, background 0.3s;
    cursor: pointer;
  }

  .pd-card.visible { opacity: 1; transform: none; }

  .pd-card:hover {
    border-color: var(--border-hover);
    background: var(--surface-hover);
    transform: translateY(-5px) !important;
  }

  .pd-img-wrap {
    width: 100%;
    aspect-ratio: 1;
    margin-bottom: 20px;
    border-radius: 10px;
    overflow: hidden;
    background: rgba(245,242,234,0.04);
  }

  .pd-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.45s var(--ease);
    filter: brightness(0.88) saturate(1.1);
  }

  .pd-card:hover .pd-img-wrap img {
    transform: scale(1.06);
  }

  .pd-cat {
    font-size: 0.62rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--accent);
    margin-bottom: 8px;
  }

  .pd-name {
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--text);
    margin-bottom: 10px;
    line-height: 1.25;
  }

  .pd-desc {
    font-size: 0.82rem;
    line-height: 1.55;
    color: var(--muted);
    margin-top: auto;
  }

  .pd-footer {
    margin-top: 60px;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
    text-align: center;
    opacity: 0;
    transform: translateY(18px);
    transition: opacity 0.6s var(--ease) 0.45s, transform 0.6s var(--ease) 0.45s;
  }

  .pd-footer.visible { opacity: 1; transform: none; }

  .pd-footer-text {
    font-size: 0.95rem;
    color: var(--muted);
  }

  .pd-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 13px 30px;
    border: 1px solid var(--accent);
    border-radius: 6px;
    color: var(--accent);
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    text-decoration: none;
    transition: background 0.25s, color 0.25s, transform 0.25s;
    cursor: pointer;
    background: transparent;
  }

  .pd-btn:hover {
    background: var(--accent);
    color: var(--bg);
    transform: translateY(-2px);
  }

  .pd-btn svg { width:15px; height:15px; stroke:currentColor; stroke-width:2.5; fill:none; flex-shrink:0; }

  @media (max-width: 1024px) {
    .pd-grid { grid-template-columns: repeat(2, 1fr); }
  }
  @media (max-width: 600px) {
    .pd-grid { grid-template-columns: 1fr; }
    .pd-header { text-align: left; }
  }
</style>
</head>
<body>
<section class="gg-section" id="gg-section" aria-label="Best Seller Products">
  <div class="inner">
    <header class="pd-header" id="pd-header">
      <span class="eyebrow">Top Selection</span>
      <h2 class="headline">Farmer's Favorites</h2>
    </header>

    <div class="pd-grid">
      <a href="#" class="pd-card" style="transition-delay:0.08s">
        <div class="pd-img-wrap">
          <img src="https://images.unsplash.com/photo-1563514227147-6d2ff665a6a0?w=600&q=80" alt="NPK Compound Pro" loading="lazy" />
        </div>
        <span class="pd-cat">Granular</span>
        <h3 class="pd-name">NPK Compound Pro</h3>
        <p class="pd-desc">Premium multi-nutrient formula for high-yield grain production.</p>
      </a>

      <a href="#" class="pd-card" style="transition-delay:0.16s">
        <div class="pd-img-wrap">
          <img src="https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=600&q=80" alt="UAN Nitro Boost" loading="lazy" />
        </div>
        <span class="pd-cat">Liquid</span>
        <h3 class="pd-name">UAN Nitro Boost</h3>
        <p class="pd-desc">Fast-uptake nitrogen solution for rapid vegetative growth.</p>
      </a>

      <a href="#" class="pd-card" style="transition-delay:0.24s">
        <div class="pd-img-wrap">
          <img src="https://images.unsplash.com/photo-1500651230702-0e2d8a49d4ad?w=600&q=80" alt="PhosMax Rooter" loading="lazy" />
        </div>
        <span class="pd-cat">Soil Health</span>
        <h3 class="pd-name">PhosMax Rooter</h3>
        <p class="pd-desc">High-solubility formula for early root establishment.</p>
      </a>

      <a href="#" class="pd-card" style="transition-delay:0.32s">
        <div class="pd-img-wrap">
          <img src="https://images.unsplash.com/photo-1574943320219-553eb213f72d?w=600&q=80" alt="MicroShield Trace" loading="lazy" />
        </div>
        <span class="pd-cat">Specialty</span>
        <h3 class="pd-name">MicroShield Trace</h3>
        <p class="pd-desc">Chelated micronutrients for improved crop quality.</p>
      </a>
    </div>

    <div class="pd-footer" id="pd-footer">
      <p class="pd-footer-text">Discover over 40+ specialized organic formulas for every crop.</p>
      <a href="products.php" class="pd-btn">
        View All Products
        <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
      </a>
    </div>
  </div>
</section>

<script>
  const cards = document.querySelectorAll('.pd-card');
  const header = document.getElementById('pd-header');
  const footer = document.getElementById('pd-footer');

  const obs = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if (e.isIntersecting) {
        e.target.classList.add('visible');
      }
    });
  }, { threshold: 0.12 });

  [header, ...cards, footer].forEach(el => obs.observe(el));
</script>
</body>
</html>
