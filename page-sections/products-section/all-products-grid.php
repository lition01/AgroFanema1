<?php // All Products Grid — GreenGrow Fertilizers 

$all_products = [
    ['name' => 'NPK Compound Pro', 'cat' => 'granular', 'img' => 'https://images.unsplash.com/photo-1563514227147-6d2ff665a6a0?w=600&q=80', 'desc' => 'Premium multi-nutrient formula for high-yield grain production.'],
    ['name' => 'UAN Nitro Boost', 'cat' => 'liquid', 'img' => 'https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=600&q=80', 'desc' => 'Fast-uptake nitrogen solution for rapid vegetative growth.'],
    ['name' => 'PhosMax Rooter', 'cat' => 'soil-health', 'img' => 'https://images.unsplash.com/photo-1500651230702-0e2d8a49d4ad?w=600&q=80', 'desc' => 'High-solubility formula for early root establishment.'],
    ['name' => 'MicroShield Trace', 'cat' => 'specialty', 'img' => 'https://images.unsplash.com/photo-1574943320219-553eb213f72d?w=600&q=80', 'desc' => 'Chelated micronutrients for improved crop quality.'],
    ['name' => 'Calcium Nitrate Sol', 'cat' => 'liquid', 'img' => 'https://images.unsplash.com/photo-1599420186946-7b6fb4e297f0?w=600&q=80', 'desc' => 'Instant calcium and nitrogen for fruit development.'],
    ['name' => 'Potash Granular Plus', 'cat' => 'granular', 'img' => 'https://images.unsplash.com/photo-1585314062340-f1a5a7c9328d?w=600&q=80', 'desc' => 'High-purity potassium for improved disease resistance.'],
    ['name' => 'BioHumic Soil Regen', 'cat' => 'soil-health', 'img' => 'https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=600&q=80', 'desc' => 'Organic humic acid to rebuild soil structure.'],
    ['name' => 'Magnesium Foliar XL', 'cat' => 'specialty', 'img' => 'https://images.unsplash.com/photo-1592150621344-2224483e47b0?w=600&q=80', 'desc' => 'Targeted magnesium spray for chlorophyll production.']
];
?>

<section class="gg-all-p-scope" aria-label="Product Catalog">
<style>
  /* ══════════════════════════════════════════════════════════
     ALL PRODUCTS GRID (Scoped)
     Panna Background with Light-Themed Modern Cards
  ══════════════════════════════════════════════════════════ */

  .gg-all-p-scope {
    --pd-bg:            #F5F2EA; /* Panna Background */
    --pd-surface:       #FFFFFF; /* White Cards */
    --pd-accent:        #C8A84B;
    --pd-text-primary:  #1A3329; /* Deep Green Text */
    --pd-text-muted:    #6B6B62;
    --pd-border:        #E2E0DA;
    --pd-font-display:  'Cormorant Garamond', Georgia, serif;
    --pd-font-body:     'Outfit', sans-serif;
    --pd-ease:          cubic-bezier(0.4, 0, 0.2, 1);
    --pd-h-pad:         48px;

    position: relative;
    width: 100%;
    background: var(--pd-bg);
    font-family: var(--pd-font-body);
    color: var(--pd-text-primary);
    padding: 80px 0 120px;
  }

  .gg-all-p-scope *,
  .gg-all-p-scope *::before,
  .gg-all-p-scope *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  .gg-all-p-scope .ap-inner {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 var(--pd-h-pad);
  }

  /* ── Grid ────────────────────────────────────────── */
  .gg-all-p-scope .ap-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
    transition: all 0.4s var(--pd-ease);
  }

  .gg-all-p-scope .ap-card {
    background: var(--pd-surface);
    border: 1px solid var(--pd-border);
    border-radius: 12px;
    padding: 24px;
    display: flex;
    flex-direction: column;
    transition: all 0.4s var(--pd-ease);
    text-decoration: none;
    color: inherit;
    box-shadow: 0 4px 12px rgba(26, 51, 41, 0.03);
  }

  .gg-all-p-scope .ap-card:hover {
    border-color: var(--pd-accent);
    transform: translateY(-5px);
    box-shadow: 0 12px 32px rgba(26, 51, 41, 0.08);
  }

  /* Compact Image (Light Match) */
  .gg-all-p-scope .ap-img-wrap {
    width: 100%;
    aspect-ratio: 1;
    margin-bottom: 24px;
    background: rgba(26, 51, 41, 0.02);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
  }

  .gg-all-p-scope .ap-img-wrap img {
    width: 90%;
    height: 90%;
    object-fit: contain;
    transition: transform 0.4s var(--pd-ease);
  }

  .gg-all-p-scope .ap-card:hover .ap-img-wrap img {
    transform: scale(1.1) rotate(2deg);
  }

  /* Content (Light Match) */
  .gg-all-p-scope .ap-card-cat {
    font-size: 0.65rem;
    color: var(--pd-accent);
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 12px;
    display: block;
  }

  .gg-all-p-scope .ap-card-name {
    font-family: var(--pd-font-display);
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--pd-text-primary);
    margin-bottom: 8px;
  }

  .gg-all-p-scope .ap-card-desc {
    font-size: 0.85rem;
    line-height: 1.5;
    color: var(--pd-text-muted);
  }

  /* ── Filter Transition ── */
  .gg-all-p-scope .ap-card.hidden {
    display: none;
  }

  /* ── Responsive ── */
  @media (max-width: 1200px) {
    .gg-all-p-scope .ap-grid { grid-template-columns: repeat(3, 1fr); }
  }

  @media (max-width: 900px) {
    .gg-all-p-scope .ap-grid { grid-template-columns: repeat(2, 1fr); }
  }

  @media (max-width: 640px) {
    .gg-all-p-scope { --pd-h-pad: 24px; }
    .gg-all-p-scope .ap-grid { grid-template-columns: 1fr; }
    .gg-all-p-scope .ap-card { padding: 32px 24px; }
  }
</style>

  <div class="ap-inner">
    <div class="ap-grid" id="productGrid">
      <?php foreach ($all_products as $product): ?>
      <a href="#" class="ap-card" data-category="<?= $product['cat'] ?>" data-name="<?= strtolower($product['name']) ?>">
        <div class="ap-img-wrap">
          <img src="<?= $product['img'] ?>" alt="<?= $product['name'] ?>" />
        </div>
        <span class="ap-card-cat"><?= str_replace('-', ' ', $product['cat']) ?></span>
        <h3 class="ap-card-name"><?= $product['name'] ?></h3>
        <p class="ap-card-desc"><?= $product['desc'] ?></p>
      </a>
      <?php endforeach; ?>
    </div>
  </div>

  <script>
    (function() {
      const scope = document.querySelector('.gg-all-p-scope');
      if (!scope) return;
      
      const grid = scope.querySelector('#productGrid');
      const cards = grid.querySelectorAll('.ap-card');

      window.addEventListener('gg-product-filter', (e) => {
        const filter = e.detail.filter;
        const search = e.detail.search || '';
        
        grid.style.opacity = '0';
        grid.style.transform = 'translateY(10px)';
        
        setTimeout(() => {
          cards.forEach(card => {
            const cardCat = card.getAttribute('data-category');
            const cardName = card.getAttribute('data-name');
            
            const matchesFilter = (filter === 'all' || cardCat === filter);
            const matchesSearch = (search === '' || cardName.includes(search));

            if (matchesFilter && matchesSearch) {
              card.classList.remove('hidden');
            } else {
              card.classList.add('hidden');
            }
          });
          
          grid.style.opacity = '1';
          grid.style.transform = 'translateY(0)';
        }, 300);
      });
    })();
  </script>
</section>