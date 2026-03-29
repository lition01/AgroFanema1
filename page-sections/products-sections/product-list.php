<?php // Product List Section — AgroFanema 
include_once "essentials/product-data.php";
?>

<section class="gg-product-list-scope" id="product-list" aria-label="AgroFanema Product Catalog">
  <style>
    .gg-product-list-scope {
      --bg:            #F5F2EA; /* Panna Background */
      --surface:       #FFFFFF;
      --accent:        #C8A84B;
      --primary:       #1A3329;
      --text:          #1A1A1A;
      --muted:         #6B6B62;
      --border:        #E2E0DA;
      --shadow-md:     rgba(26, 51, 41, 0.13);
      --shadow-lg:     rgba(26, 51, 41, 0.18);
      --ease:          cubic-bezier(0.4, 0, 0.2, 1);
      --ease-out:      cubic-bezier(0.16, 1, 0.3, 1);
      
      font-family: 'Outfit', sans-serif;
      background: var(--bg);
      color: var(--text);
      padding: 60px clamp(20px, 4vw, 40px) 60px; /* Reduced top/bottom padding */
      position: relative;
      overflow: hidden;
    }

    .gg-product-list-scope .inner {
      max-width: 1600px;
      margin: 0 auto;
      position: relative;
      z-index: 1;
    }

    /* ── Page Header ───────────────────────────── */
    .gg-product-list-scope .page-header {
      text-align: center;
      margin-bottom: 32px; /* Reduced from 60px */
    }

    .gg-product-list-scope .header-eyebrow {
      display: block;
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.25em;
      color: var(--accent);
      margin-bottom: 16px;
    }

    .gg-product-list-scope .page-header h1 {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(2.2rem, 4vw, 3.5rem); /* Slightly smaller */
      font-weight: 600;
      color: var(--primary);
      margin-bottom: 16px;
      letter-spacing: -0.01em;
    }

    .gg-product-list-scope .page-header p {
      font-size: 1.05rem; /* Slightly smaller */
      color: var(--muted);
      max-width: 580px;
      margin: 0 auto;
      line-height: 1.6;
      font-weight: 300;
    }

    /* ── Controls Bar ──────────────────────────── */
    .gg-product-list-scope .product-controls {
      display: flex;
      align-items: center;
      gap: 24px;
      margin-bottom: 48px; /* Reduced from 80px */
      padding-bottom: 20px; /* Reduced from 28px */
      border-bottom: 1px solid var(--border);
    }

    .gg-product-list-scope .control-btns {
      display: flex;
      gap: 16px;
    }

    .gg-product-list-scope .control-btn {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 12px 28px;
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 8px;
      font-size: 0.85rem;
      font-weight: 700; /* Bold Font */
      color: var(--text);
      cursor: pointer;
      transition: all 0.3s var(--ease);
      box-shadow: 0 2px 8px rgba(26, 51, 41, 0.04);
      letter-spacing: 0.02em;
    }

    .gg-product-list-scope .control-btn:hover,
    .gg-product-list-scope .control-btn[aria-expanded="true"] {
      border-color: var(--accent);
      background: #FAFAF8;
    }

    .gg-product-list-scope .control-btn svg {
      width: 18px;
      height: 18px;
      stroke: currentColor;
      stroke-width: 1.5;
      fill: none;
    }

    .gg-product-list-scope .product-count {
      font-size: 0.95rem;
      color: var(--accent);
      font-family: 'Cormorant Garamond', serif;
      font-style: italic;
      font-weight: 500;
      opacity: 0.8;
      margin-left: auto;
    }

    /* ── Dropdowns ────────────────────────────── */
    .gg-product-list-scope .dropdown-wrapper {
      position: relative;
    }

    .gg-product-list-scope .filter-dropdown,
    .gg-product-list-scope .sort-dropdown {
      position: absolute;
      top: calc(100% + 20px);
      left: 0;
      width: 300px;
      background: rgba(255, 255, 255, 0.98);
      backdrop-filter: blur(20px);
      border: 1px solid var(--border);
      border-radius: 20px;
      padding: 20px;
      box-shadow: 0 20px 50px var(--shadow-lg);
      opacity: 0;
      visibility: hidden;
      transform: translateY(20px);
      transition: all 0.5s var(--ease);
      z-index: 100;
    }

    .gg-product-list-scope .dropdown-wrapper.is-open .filter-dropdown,
    .gg-product-list-scope .dropdown-wrapper.is-open .sort-dropdown {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }

    .gg-product-list-scope .dropdown-menu {
      list-style: none;
      margin: 0;
      padding: 0;
    }

    .gg-product-list-scope .dropdown-item {
      margin-bottom: 4px;
    }

    .gg-product-list-scope .dropdown-link {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 12px 16px;
      border-radius: 10px;
      text-decoration: none;
      color: var(--text);
      font-size: 0.85rem;
      font-weight: 700; /* Bold Font */
      transition: all 0.2s var(--ease);
      background: transparent;
      border: none;
      width: 100%;
      cursor: pointer;
      text-align: left;
    }

    .gg-product-list-scope .dropdown-link:hover,
    .gg-product-list-scope .dropdown-link:focus {
      background: var(--bg);
      color: var(--primary);
    }

    .gg-product-list-scope .dropdown-link.active {
      background: var(--primary);
      color: #FFFFFF;
    }

    .gg-product-list-scope .dropdown-link .item-count {
      font-size: 0.7rem;
      opacity: 0.5;
      font-weight: 400;
    }

    /* ── Product Grid ──────────────────────────── */
    .gg-product-list-scope .product-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr); /* Reverted to 4 items per row */
      gap: 32px 24px;
    }

    .gg-product-list-scope .product-card {
      display: flex;
      flex-direction: column;
      text-decoration: none;
      color: inherit;
      position: relative;
      background: var(--bg);
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 10px 30px rgba(26, 51, 41, 0.08); /* Simplified shadow */
      transition: all 0.4s var(--ease);
      height: 100%;
      aspect-ratio: 0.8; /* Reverted to professional portrait ratio */
      opacity: 0;
      transform: translateY(20px);
      animation: gg-card-reveal 0.6s var(--ease) forwards;
      border: none;
    }

    @keyframes gg-card-reveal {
      to { opacity: 1; transform: translateY(0); }
    }

    .gg-product-list-scope .product-card.hidden {
      display: none !important;
    }

    .gg-product-list-scope .product-img-wrap {
      width: 100%;
      height: 78%;
      background: #EBE8DE;
      overflow: hidden;
      position: relative;
    }

    .gg-product-list-scope .product-img-wrap img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.8s var(--ease);
    }

    .gg-product-list-scope .product-card:hover {
      box-shadow: 0 20px 40px rgba(26, 51, 41, 0.15);
    }

    .gg-product-list-scope .product-card:hover .product-img-wrap img {
      transform: scale(1.05);
    }

    /* ── Product Info ─────────────────────────── */
    .gg-product-list-scope .product-info {
      height: 22%;
      padding: 16px 20px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      text-align: left;
      background: var(--bg);
    }

    .gg-product-list-scope .product-name {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.4rem; /* Restored size for 4-column cards */
      font-weight: 600;
      color: var(--primary);
      margin-bottom: 4px;
      line-height: 1.2;
      display: -webkit-box;
      -webkit-line-clamp: 1;
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .gg-product-list-scope .product-price {
      display: block;
      font-family: 'Outfit', sans-serif;
      font-weight: 500;
      font-size: 0.9rem;
      color: var(--accent);
      letter-spacing: 0.02em;
      opacity: 0.9;
    }

    /* ── Responsive ────────────────────────────── */
    @media (max-width: 1200px) {
      .gg-product-list-scope .product-grid { grid-template-columns: repeat(4, 1fr); }
    }

    @media (max-width: 1024px) {
      .gg-product-list-scope .product-grid { grid-template-columns: repeat(3, 1fr); gap: 32px 24px; }
      .gg-product-list-scope .product-name { font-size: 1.4rem; }
      .gg-product-list-scope .product-controls { flex-direction: column; gap: 32px; align-items: center; text-align: center; }
      .gg-product-list-scope .product-count { margin-left: 0; }

      .gg-product-list-scope .filter-dropdown,
      .gg-product-list-scope .sort-dropdown {
        position: fixed;
        top: auto;
        bottom: 0;
        left: 0;
        right: 0;
        width: 100%;
        height: 50svh;
        border-radius: 32px 32px 0 0;
        transform: translateY(100%);
        padding: 40px 24px 32px;
        box-shadow: 0 -15px 50px rgba(13, 33, 23, 0.12);
        overflow-y: auto;
        visibility: visible;
        opacity: 1;
        transition: transform 0.5s var(--ease);
        z-index: 1000;
      }

      .gg-product-list-scope .dropdown-wrapper.is-open .filter-dropdown,
      .gg-product-list-scope .dropdown-wrapper.is-open .sort-dropdown {
        transform: translateY(0);
      }

      .gg-product-list-scope .filter-dropdown::before,
      .gg-product-list-scope .sort-dropdown::before {
        content: '';
        position: absolute;
        top: 14px;
        left: 50%;
        transform: translateX(-50%);
        width: 45px;
        height: 5px;
        background: var(--border);
        border-radius: 10px;
      }
    }

    @media (max-width: 767px) {
      .gg-product-list-scope {
        padding: 40px 16px 80px;
      }

      .gg-product-list-scope .product-grid {
        grid-template-columns: repeat(2, 1fr); /* 2 items per row on mobile */
        gap: 20px 12px;
      }

      .gg-product-list-scope .product-card {
        aspect-ratio: 0.75;
        border-radius: 12px;
      }

      .gg-product-list-scope .product-img-wrap {
        height: 72%;
      }

      .gg-product-list-scope .product-info {
        height: 28%;
        padding: 12px 14px;
      }

      .gg-product-list-scope .product-name {
        font-size: 1.1rem;
      }
    }

    @media (max-width: 480px) {
      .gg-product-list-scope .product-card {
        aspect-ratio: 0.7;
      }
      .gg-product-list-scope .product-name {
        font-size: 1rem;
      }
    }
  </style>

  <div class="inner">
    <header class="page-header">
      <span class="header-eyebrow">Premium Nutrients</span>
      <h1>Our Collection</h1>
      <p>Premium organic fertilizers crafted for exceptional plant growth and sustainable gardening</p>
    </header>

    <div class="product-controls">
      <div class="control-btns">
        <!-- Filter Dropdown -->
        <div class="dropdown-wrapper" id="filter-dropdown-wrapper">
          <button class="control-btn" id="filter-btn" aria-haspopup="true" aria-expanded="false" aria-controls="filter-menu">
            <svg viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
            Filter
            <svg class="chevron-icon" viewBox="0 0 24 24" style="width:14px; height:14px; opacity:0.6;"><path d="M6 9l6 6 6-6"/></svg>
          </button>
          
          <div class="filter-dropdown" id="filter-menu" role="menu" aria-labelledby="filter-btn">
            <ul class="dropdown-menu">
              <li role="none" class="dropdown-item">
                <button class="dropdown-link active" role="menuitem" data-filter="all">
                  Show All
                  <span class="item-count"><?php echo count($products); ?></span>
                </button>
              </li>
              <?php 
              $categories = array_unique(array_column($products, 'category'));
              foreach($categories as $cat): 
                $count = count(array_filter($products, function($p) use ($cat) { return $p['category'] === $cat; }));
              ?>
              <li role="none" class="dropdown-item">
                <button class="dropdown-link" role="menuitem" data-filter="<?php echo $cat; ?>">
                  <?php echo ucfirst($cat); ?>
                  <span class="item-count"><?php echo $count; ?></span>
                </button>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>

        <!-- Sort Dropdown -->
        <div class="dropdown-wrapper" id="sort-dropdown-wrapper">
          <button class="control-btn" id="sort-btn" aria-haspopup="true" aria-expanded="false" aria-controls="sort-menu">
            <svg viewBox="0 0 24 24"><path d="M3 6h18M6 12h12M10 18h4"/></svg>
            Sort
            <svg class="chevron-icon" viewBox="0 0 24 24" style="width:14px; height:14px; opacity:0.6;"><path d="M6 9l6 6 6-6"/></svg>
          </button>
          
          <div class="sort-dropdown" id="sort-menu" role="menu" aria-labelledby="sort-btn">
            <ul class="dropdown-menu">
              <li role="none" class="dropdown-item">
                <button class="dropdown-link active" role="menuitem" data-sort="default">Default</button>
              </li>
              <li role="none" class="dropdown-item">
                <button class="dropdown-link" role="menuitem" data-sort="az">Name: A - Z</button>
              </li>
              <li role="none" class="dropdown-item">
                <button class="dropdown-link" role="menuitem" data-sort="za">Name: Z - A</button>
              </li>
            </ul>
          </div>
        </div>
      </div>
      
      <span class="product-count" id="product-count">
        Viewing <?php echo count($products); ?> products
      </span>
    </div>

    <div class="product-grid" id="product-grid">
      <?php 
      $idx = 0;
      foreach ($products as $id => $p): 
        $idx++;
      ?>
      <a href="product-view.php?id=<?php echo $id; ?>" 
         class="product-card" 
         data-category="<?php echo $p['category']; ?>"
         data-name="<?php echo htmlspecialchars($p['name']); ?>"
         data-price="<?php echo $p['price']; ?>"
         style="animation-delay: <?php echo $idx * 0.08; ?>s"
         data-id="<?php echo $id; ?>">
        <div class="product-img-wrap">
          <img src="<?php echo $p['image']; ?>" alt="<?php echo $p['name']; ?>" loading="lazy">
        </div>
        <div class="product-info">
          <h3 class="product-name"><?php echo $p['name']; ?></h3>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const filterWrapper = document.getElementById('filter-dropdown-wrapper');
      const sortWrapper = document.getElementById('sort-dropdown-wrapper');
      const filterBtn = document.getElementById('filter-btn');
      const sortBtn = document.getElementById('sort-btn');
      const filterLinks = filterWrapper.querySelectorAll('.dropdown-link');
      const sortLinks = sortWrapper.querySelectorAll('.dropdown-link');
      const grid = document.getElementById('product-grid');
      const products = Array.from(grid.querySelectorAll('.product-card'));
      const productCountDisplay = document.getElementById('product-count');

      let currentFilter = 'all';
      let currentSort = 'default';

      // ── Dropdown Toggles ────────────────────────
      filterBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        const isOpen = filterWrapper.classList.contains('is-open');
        closeAllDropdowns();
        if (!isOpen) {
          filterWrapper.classList.add('is-open');
          filterBtn.setAttribute('aria-expanded', 'true');
        }
      });

      sortBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        const isOpen = sortWrapper.classList.contains('is-open');
        closeAllDropdowns();
        if (!isOpen) {
          sortWrapper.classList.add('is-open');
          sortBtn.setAttribute('aria-expanded', 'true');
        }
      });

      document.addEventListener('click', () => closeAllDropdowns());

      function closeAllDropdowns() {
        filterWrapper.classList.remove('is-open');
        sortWrapper.classList.remove('is-open');
        filterBtn.setAttribute('aria-expanded', 'false');
        sortBtn.setAttribute('aria-expanded', 'false');
      }

      // ── Sorting Logic ───────────────────────────
      function applySort() {
        const sorted = [...products].sort((a, b) => {
          const nameA = a.getAttribute('data-name').toLowerCase();
          const nameB = b.getAttribute('data-name').toLowerCase();
          const priceA = parseFloat(a.getAttribute('data-price'));
          const priceB = parseFloat(b.getAttribute('data-price'));

          switch (currentSort) {
            case 'az': return nameA.localeCompare(nameB);
            case 'za': return nameB.localeCompare(nameA);
            case 'low-high': return priceA - priceB;
            case 'high-low': return priceB - priceA;
            default: return 0;
          }
        });

        if (currentSort === 'default') {
          products.forEach(p => grid.appendChild(p));
        } else {
          sorted.forEach(p => grid.appendChild(p));
        }
      }

      // ── Filtering Logic ─────────────────────────
      function applyFilter() {
        let visibleCount = 0;
        products.forEach(product => {
          const category = product.getAttribute('data-category');
          if (currentFilter === 'all' || category === currentFilter) {
            product.classList.remove('hidden');
            visibleCount++;
          } else {
            product.classList.add('hidden');
          }
        });
        productCountDisplay.textContent = `Viewing ${visibleCount} products`;
      }

      // ── Event Handlers ──────────────────────────
      filterLinks.forEach(link => {
        link.addEventListener('click', () => {
          filterLinks.forEach(l => l.classList.remove('active'));
          link.classList.add('active');
          currentFilter = link.getAttribute('data-filter');
          applyFilter();
          closeAllDropdowns();
        });
      });

      sortLinks.forEach(link => {
        link.addEventListener('click', () => {
          sortLinks.forEach(l => l.classList.remove('active'));
          link.classList.add('active');
          currentSort = link.getAttribute('data-sort');
          applySort();
          applyFilter();
          closeAllDropdowns();
        });
      });

      // Keyboard support
      [filterWrapper, sortWrapper].forEach(wrapper => {
        wrapper.addEventListener('keydown', (e) => {
          if (e.key === 'Escape') closeAllDropdowns();
        });
      });
    });
  </script>
</section>
