<?php // Best Seller Products Section — AgroFanema ?>

<section class="gg-section" id="gg-section" aria-label="AgroFanema Best Sellers">
  <style>
    .gg-section {
      --bg:            #0D2117; /* Dark Green Background */
      --surface:       #F5F2EA; /* Panna cards */
      --accent:        #C8A84B;
      --primary:       #1A3329; /* Dark green for card text */
      --text:          #F5F2EA; /* Panna text for section headers */
      --muted:         rgba(245, 242, 234, 0.65);
      --border:        rgba(245, 242, 234, 0.1);
      --ease:          cubic-bezier(0.4, 0, 0.2, 1);
      
      font-family: 'Outfit', sans-serif;
      background: var(--bg);
      color: var(--text);
      padding: clamp(30px, 4vw, 50px) clamp(20px, 4vw, 48px);
      position: relative;
      overflow: hidden;
    }

    .gg-section .inner {
      max-width: 1400px; /* Expanded from 1200px */
      margin: 0 auto;
      display: flex;
      flex-direction: row;
      align-items: center;
      justify-content: space-between;
      gap: 60px;
      text-align: left;
    }

    /* ── Text Content ─────────────────────────── */
    .gg-section .content-side {
      flex: 1;
      max-width: 500px;
      z-index: 5;
    }

    .gg-section .intro-text {
      font-size: 0.95rem;
      font-weight: 400;
      color: var(--muted);
      margin-bottom: 12px;
      line-height: 1.6;
      opacity: 0;
      animation: gg-hero-reveal 1.2s cubic-bezier(0.19, 1, 0.22, 1) 0.5s forwards;
    }

    .gg-section.visible .intro-text {
      opacity: 1;
    }

    .gg-section .headline {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(2rem, 4vw, 3.2rem);
      font-weight: 600;
      color: var(--text);
      line-height: 1.1;
      margin-bottom: 30px;
      opacity: 0;
      animation: gg-hero-reveal 1.2s cubic-bezier(0.19, 1, 0.22, 1) 0.7s forwards;
    }

    .gg-section.visible .headline {
      opacity: 1;
    }

    /* ── Product Stack ─────────────────────────── */
    .gg-section .stack-side {
      flex: 1.2;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
    }

    .gg-section .product-stack {
      position: relative;
      width: 100%;
      height: clamp(300px, 35vw, 420px);
      display: flex;
      justify-content: center;
      align-items: center;
      transition: transform 0.6s var(--ease);
      opacity: 0;
      animation: gg-hero-reveal 1.2s cubic-bezier(0.19, 1, 0.22, 1) 0.9s forwards;
    }

    .gg-section .stack-item {
      position: absolute;
      width: clamp(160px, 18vw, 260px);
      aspect-ratio: 0.85;
      background: var(--surface);
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
      transition: all 0.6s var(--ease);
      opacity: 0;
    }

    .gg-section .stack-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* Stack Layering - Static */
    .gg-section .stack-item-1 {
      z-index: 1;
      transform: translateX(-35%) rotate(-4deg);
    }
    .gg-section .stack-item-2 {
      z-index: 3;
      transform: translateY(0);
    }
    .gg-section .stack-item-3 {
      z-index: 2;
      transform: translateX(35%) rotate(4deg);
    }

    .gg-section.visible .stack-item {
      opacity: 1;
    }

    /* Minimalist Hover Effect - All cards together */
    .gg-section .product-stack:hover {
      transform: translateY(-8px);
    }

    .gg-section .product-stack:hover .stack-item {
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
    }

    /* ── Buttons ─────────────────────────────── */
    .gg-section .pd-footer {
      display: flex;
      gap: 16px;
      opacity: 0;
      animation: gg-hero-reveal 1.2s cubic-bezier(0.19, 1, 0.22, 1) 1.1s forwards;
    }

    .gg-section.visible .pd-footer {
      opacity: 1;
    }

    @keyframes gg-hero-reveal {
      0% {
        opacity: 0;
        transform: translateY(30px);
        filter: blur(8px);
      }
      100% {
        opacity: 1;
        transform: translateY(0);
        filter: blur(0);
      }
    }

    .gg-section .pd-btn {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 12px 28px;
      border-radius: 100px;
      font-size: 0.9rem;
      font-weight: 500;
      letter-spacing: 0.5px;
      text-decoration: none;
      transition: all 0.3s var(--ease);
    }

    .gg-section .pd-btn-primary {
      background: var(--accent);
      color: #000;
    }

    .gg-section .pd-btn-primary:hover {
      background: #E0BD54;
    }

    .gg-section .pd-btn-outline {
      border: 1px solid rgba(245, 242, 234, 0.3);
      color: var(--text);
    }

    .gg-section .pd-btn-outline:hover {
      background: rgba(245, 242, 234, 0.05);
      border-color: var(--text);
    }

    .gg-section .pd-btn svg {
      width: 16px;
      height: 16px;
      stroke: currentColor;
      stroke-width: 2;
      fill: none;
    }

    @media (max-width: 991px) {
      .gg-section .inner {
        flex-direction: column;
        text-align: center;
        gap: 40px;
      }
      .gg-section .content-side {
        max-width: 600px;
      }
      .gg-section .pd-footer {
        justify-content: center;
      }
      .gg-section .stack-side {
        width: 100%;
      }
    }

    @media (max-width: 767px) {
      .gg-section {
        padding: 40px 20px;
      }
      .gg-section .product-stack {
        height: 320px;
      }
      .gg-section .stack-item {
        width: 170px;
      }
      .gg-section .pd-footer {
        flex-direction: column;
        width: 100%;
        max-width: 260px;
        margin: 0 auto;
      }
      .gg-section .pd-btn {
        width: 100%;
        justify-content: center;
      }
    }
  </style>

  <div class="inner">
    <div class="content-side">
      <p class="intro-text">
        Premium Organic Solutions
      </p>
      
      <h2 class="headline">Elevate your harvest with our <em>curated</em> selection of fertilizers.</h2>

      <div class="pd-footer">
        <a href="products.php" class="pd-btn pd-btn-primary">
          View Collection
          <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
        <a href="contact.php" class="pd-btn pd-btn-outline">
          Get in Touch
        </a>
      </div>
    </div>

    <div class="stack-side">
      <div class="product-stack">
        <?php 
        include_once "essentials/product-data.php";
        $display_products = array_slice($products, 0, 3);
        $i = 1;
        foreach ($display_products as $id => $p): 
        ?>
        <a href="product-view.php?id=<?php echo $id; ?>" class="stack-item stack-item-<?php echo $i; ?>">
          <img src="<?php echo $p['image']; ?>" alt="<?php echo $p['name']; ?>" loading="lazy" />
        </a>
        <?php 
          $i++;
        endforeach; 
        ?>
      </div>
    </div>
  </div>

  <script>
    (function() {
      const section = document.querySelector('#gg-section');
      const obs = new IntersectionObserver((entries) => {
        entries.forEach(e => {
          if (e.isIntersecting) {
            section.classList.add('visible');
          }
        });
      }, { threshold: 0.2 });
      obs.observe(section);
    })();
  </script>
</section>
