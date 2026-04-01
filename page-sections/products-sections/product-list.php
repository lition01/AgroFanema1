<?php // Product List Section — AgroFanema 
$dataFile = __DIR__ . '/../../essentials/products.json';
$products = [];
if (file_exists($dataFile)) {
    $products = json_decode(file_get_contents($dataFile), true) ?: [];
}
?>

<section class="gg-product-list-scope" id="product-list" aria-label="AgroFanema Product Catalog">
  <style>
    /* ── Design Tokens ─────────────────────────── */
    .gg-product-list-scope {
      --bg: #F5F2EA;
      --surface: #FFFFFF;
      --accent: #C8A84B;
      --primary: #1A3329;
      --text: #1A1A1A;
      --muted: #6B6B62;
      --border: #E2E0DA;
      --pill-bg: rgba(255, 255, 255, 0.75);
      --pill-active-bg: var(--primary);
      --pill-active-txt: #FFFFFF;
      --shadow-sm: 0 2px 8px rgba(26, 51, 41, 0.06);
      --shadow-md: 0 8px 24px rgba(26, 51, 41, 0.10);
      --shadow-lg: 0 20px 50px rgba(26, 51, 41, 0.15);
      --ease: cubic-bezier(0.4, 0, 0.2, 1);
      --ease-out: cubic-bezier(0.16, 1, 0.3, 1);

      font-family: 'Outfit', sans-serif;
      background: var(--bg);
      color: var(--text);
      padding: 60px clamp(20px, 4vw, 40px) 80px;
      position: relative;
    }

    .gg-product-list-scope .inner {
      max-width: 1600px;
      margin: 0 auto;
      position: relative;
      z-index: 1;
    }

    /* ── Page Header ─────────────────────────────── */
    .gg-product-list-scope .page-header {
      text-align: center;
      margin-bottom: 40px;
    }

    .gg-product-list-scope .header-eyebrow {
      display: block;
      font-size: 0.72rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.28em;
      color: var(--accent);
      margin-bottom: 14px;
    }

    .gg-product-list-scope .page-header h1 {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(2.2rem, 4vw, 3.5rem);
      font-weight: 600;
      color: var(--primary);
      margin-bottom: 14px;
      letter-spacing: -0.01em;
    }

    .gg-product-list-scope .page-header p {
      font-size: 1.05rem;
      color: var(--muted);
      max-width: 560px;
      margin: 0 auto;
      line-height: 1.65;
      font-weight: 300;
    }

    /* ── Controls Bar ─────────────────────────────── */
    .gg-product-list-scope .controls-bar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 20px;
      margin-bottom: 48px;
      padding-bottom: 24px;
      border-bottom: 1px solid var(--border);
      flex-wrap: wrap;
    }

    /* ── Filter Dropdown (mirrors Sort) ─────────────── */
    .gg-product-list-scope .filter-wrapper {
      position: relative;
    }

    .gg-product-list-scope .filter-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 9px 18px;
      background: var(--surface);
      border: 1.5px solid var(--border);
      border-radius: 100px;
      font-size: 0.82rem;
      font-weight: 600;
      color: var(--text);
      cursor: pointer;
      transition: all 0.25s var(--ease);
      box-shadow: var(--shadow-sm);
      letter-spacing: 0.01em;
      white-space: nowrap;
    }

    .gg-product-list-scope .filter-btn:hover,
    .gg-product-list-scope .filter-btn[aria-expanded="true"] {
      border-color: var(--accent);
      box-shadow: var(--shadow-md);
    }

    .gg-product-list-scope .filter-btn svg.filter-icon {
      width: 15px;
      height: 15px;
      stroke: var(--muted);
      stroke-width: 1.7;
      fill: none;
      stroke-linecap: round;
      stroke-linejoin: round;
      flex-shrink: 0;
    }

    .gg-product-list-scope .filter-btn .filter-label {
      color: var(--muted);
      font-weight: 400;
      margin-right: 2px;
    }

    .gg-product-list-scope .filter-btn .filter-current {
      color: var(--primary);
      font-weight: 700;
    }

    .gg-product-list-scope .filter-btn svg.chevron {
      width: 12px;
      height: 12px;
      stroke: var(--muted);
      stroke-width: 2;
      fill: none;
      stroke-linecap: round;
      stroke-linejoin: round;
      transition: transform 0.25s var(--ease);
      margin-left: 2px;
    }

    .gg-product-list-scope .filter-btn[aria-expanded="true"] svg.chevron {
      transform: rotate(180deg);
    }

    /* Filter Dropdown Panel */
    .gg-product-list-scope .filter-dropdown {
      position: absolute;
      top: calc(100% + 10px);
      left: 0;
      width: 230px;
      background: rgba(255, 255, 255, 0.98);
      backdrop-filter: blur(20px);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 8px;
      box-shadow: var(--shadow-lg);
      opacity: 0;
      visibility: hidden;
      transform: translateY(10px) scale(0.97);
      transform-origin: top left;
      transition: all 0.3s var(--ease-out);
      z-index: 200;
    }

    .gg-product-list-scope .filter-wrapper.is-open .filter-dropdown {
      opacity: 1;
      visibility: visible;
      transform: translateY(0) scale(1);
    }

    .gg-product-list-scope .filter-option {
      display: flex;
      align-items: center;
      gap: 10px;
      width: 100%;
      padding: 10px 14px;
      border: none;
      background: transparent;
      border-radius: 10px;
      font-size: 0.84rem;
      font-weight: 500;
      color: var(--muted);
      cursor: pointer;
      text-align: left;
      transition: all 0.18s var(--ease);
    }

    .gg-product-list-scope .filter-option:hover {
      background: var(--bg);
      color: var(--primary);
    }

    .gg-product-list-scope .filter-option.active {
      background: var(--primary);
      color: #FFFFFF;
      font-weight: 700;
    }

    .gg-product-list-scope .filter-option svg {
      width: 14px;
      height: 14px;
      stroke: currentColor;
      stroke-width: 1.8;
      fill: none;
      stroke-linecap: round;
      stroke-linejoin: round;
      flex-shrink: 0;
      opacity: 0.7;
    }

    .gg-product-list-scope .filter-divider {
      height: 1px;
      background: var(--border);
      margin: 6px 8px;
    }

    /* ── Controls Left + Right ─────────────────────── */
    .gg-product-list-scope .controls-left {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .gg-product-list-scope .controls-right {
      display: flex;
      align-items: center;
      gap: 16px;
      flex-shrink: 0;
    }

    /* ── Sort Dropdown ─────────────────────────────── */
    .gg-product-list-scope .sort-wrapper {
      position: relative;
    }

    .gg-product-list-scope .sort-btn {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 9px 18px;
      background: var(--surface);
      border: 1.5px solid var(--border);
      border-radius: 100px;
      font-size: 0.82rem;
      font-weight: 600;
      color: var(--text);
      cursor: pointer;
      transition: all 0.25s var(--ease);
      box-shadow: var(--shadow-sm);
      letter-spacing: 0.01em;
      white-space: nowrap;
    }

    .gg-product-list-scope .sort-btn:hover,
    .gg-product-list-scope .sort-btn[aria-expanded="true"] {
      border-color: var(--accent);
      box-shadow: var(--shadow-md);
    }

    .gg-product-list-scope .sort-btn svg.sort-icon {
      width: 15px;
      height: 15px;
      stroke: var(--muted);
      stroke-width: 1.7;
      fill: none;
      stroke-linecap: round;
      stroke-linejoin: round;
      flex-shrink: 0;
    }

    .gg-product-list-scope .sort-btn .sort-label {
      color: var(--muted);
      font-weight: 400;
      margin-right: 2px;
    }

    .gg-product-list-scope .sort-btn .sort-current {
      color: var(--primary);
      font-weight: 700;
    }

    .gg-product-list-scope .sort-btn svg.chevron {
      width: 12px;
      height: 12px;
      stroke: var(--muted);
      stroke-width: 2;
      fill: none;
      stroke-linecap: round;
      stroke-linejoin: round;
      transition: transform 0.25s var(--ease);
      margin-left: 2px;
    }

    .gg-product-list-scope .sort-btn[aria-expanded="true"] svg.chevron {
      transform: rotate(180deg);
    }

    /* Sort Dropdown Panel */
    .gg-product-list-scope .sort-dropdown {
      position: absolute;
      top: calc(100% + 10px);
      right: 0;
      width: 230px;
      background: rgba(255, 255, 255, 0.98);
      backdrop-filter: blur(20px);
      border: 1px solid var(--border);
      border-radius: 16px;
      padding: 8px;
      box-shadow: var(--shadow-lg);
      opacity: 0;
      visibility: hidden;
      transform: translateY(10px) scale(0.97);
      transform-origin: top right;
      transition: all 0.3s var(--ease-out);
      z-index: 200;
    }

    .gg-product-list-scope .sort-wrapper.is-open .sort-dropdown {
      opacity: 1;
      visibility: visible;
      transform: translateY(0) scale(1);
    }

    .gg-product-list-scope .sort-option {
      display: flex;
      align-items: center;
      gap: 10px;
      width: 100%;
      padding: 10px 14px;
      border: none;
      background: transparent;
      border-radius: 10px;
      font-size: 0.84rem;
      font-weight: 500;
      color: var(--muted);
      cursor: pointer;
      text-align: left;
      transition: all 0.18s var(--ease);
    }

    .gg-product-list-scope .sort-option:hover {
      background: var(--bg);
      color: var(--primary);
    }

    .gg-product-list-scope .sort-option.active {
      background: var(--primary);
      color: #FFFFFF;
      font-weight: 700;
    }

    .gg-product-list-scope .sort-option svg {
      width: 14px;
      height: 14px;
      stroke: currentColor;
      stroke-width: 1.8;
      fill: none;
      stroke-linecap: round;
      stroke-linejoin: round;
      flex-shrink: 0;
      opacity: 0.7;
    }

    .gg-product-list-scope .sort-divider {
      height: 1px;
      background: var(--border);
      margin: 6px 8px;
    }

    /* ── Product Count ─────────────────────────────── */
    .gg-product-list-scope .product-count-chip {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 6px 14px;
      background: transparent;
      border: 1.5px solid var(--border);
      border-radius: 100px;
      font-size: 0.78rem;
      font-weight: 500;
      color: var(--muted);
      white-space: nowrap;
      letter-spacing: 0.01em;
    }

    .gg-product-list-scope .product-count-chip strong {
      color: var(--primary);
      font-weight: 700;
    }

    /* ── Product Grid ──────────────────────────────── */
    .gg-product-list-scope .product-grid {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
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
      box-shadow: var(--shadow-sm);
      transition: box-shadow 0.4s var(--ease), transform 0.4s var(--ease);
      height: 100%;
      aspect-ratio: 0.8;
      border: 1px solid transparent;
      opacity: 0;
      transform: translateY(18px);
      animation: gg-card-reveal 0.55s var(--ease-out) forwards;
    }

    .gg-product-list-scope .product-card.is-filtering {
      transition: opacity 0.2s ease, transform 0.2s ease;
    }

    @keyframes gg-card-reveal {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .gg-product-list-scope .product-card.hidden {
      display: none !important;
    }

    .gg-product-list-scope .product-card:hover {
      box-shadow: var(--shadow-lg);
      transform: translateY(-4px);
      border-color: var(--border);
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
      transition: transform 0.7s var(--ease);
    }

    .gg-product-list-scope .product-card:hover .product-img-wrap img {
      transform: scale(1.05);
    }

    /* Category badge on card */
    .gg-product-list-scope .card-badge {
      position: absolute;
      top: 12px;
      left: 12px;
      padding: 4px 10px;
      background: rgba(255, 255, 255, 0.88);
      backdrop-filter: blur(8px);
      border-radius: 100px;
      font-size: 0.65rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      color: var(--primary);
    }

    .gg-product-list-scope .product-info {
      height: 22%;
      padding: 16px 20px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      background: var(--bg);
    }

    .gg-product-list-scope .product-name {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.4rem;
      font-weight: 600;
      color: var(--primary);
      margin-bottom: 2px;
      line-height: 1.2;
      display: -webkit-box;
      -webkit-line-clamp: 1;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }



    /* No results state */
    .gg-product-list-scope .no-results {
      grid-column: 1 / -1;
      text-align: center;
      padding: 80px 20px;
      display: none;
    }

    .gg-product-list-scope .no-results.visible {
      display: block;
    }

    .gg-product-list-scope .no-results svg {
      width: 48px;
      height: 48px;
      stroke: var(--border);
      stroke-width: 1.5;
      fill: none;
      margin-bottom: 16px;
    }

    .gg-product-list-scope .no-results p {
      color: var(--muted);
      font-size: 0.95rem;
    }

    /* ── Responsive ────────────────────────────────── */
    @media (max-width: 1200px) {
      .gg-product-list-scope .product-grid {
        grid-template-columns: repeat(4, 1fr);
      }
    }

    @media (max-width: 1024px) {
      .gg-product-list-scope .product-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 28px 20px;
      }

      .gg-product-list-scope .controls-bar {
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
      }

      .gg-product-list-scope .controls-right {
        width: auto;
      }
    }

    @media (max-width: 767px) {
      .gg-product-list-scope {
        padding: 40px 16px 80px;
      }

      .gg-product-list-scope .product-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px 12px;
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
        font-size: 1rem;
      }

      .gg-product-list-scope .card-badge {
        top: 8px;
        left: 8px;
        padding: 3px 8px;
        font-size: 0.55rem;
      }

      /* Mobile Controls Layout - strictly single row */
      .gg-product-list-scope .controls-bar {
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        margin-bottom: 24px;
        padding-bottom: 16px;
        flex-wrap: nowrap;
      }

      .gg-product-list-scope .controls-left,
      .gg-product-list-scope .controls-right {
        width: auto;
        flex: 1;
        min-width: 0;
      }

      .gg-product-list-scope .controls-right {
        justify-content: flex-end;
        gap: 8px;
      }

      .gg-product-list-scope .product-count-chip {
        display: inline-flex;
        padding: 5px 8px;
        font-size: 0.6rem;
        order: -1;
        border-color: var(--border);
        background: var(--surface);
        white-space: nowrap;
      }

      .gg-product-list-scope .filter-btn,
      .gg-product-list-scope .sort-btn {
        padding: 7px 10px;
        font-size: 0.75rem;
        gap: 4px;
        width: auto;
        justify-content: center;
      }

      .gg-product-list-scope .filter-label,
      .gg-product-list-scope .sort-label {
        display: none;
      }

      .gg-product-list-scope .sort-dropdown,
      .gg-product-list-scope .filter-dropdown {
        position: fixed;
        top: auto;
        bottom: 0;
        left: 0;
        right: 0;
        width: 100%;
        border-radius: 24px 24px 0 0;
        transform: translateY(100%);
        transform-origin: bottom center;
        padding: 20px 16px 40px;
        z-index: 1000;
        visibility: visible;
        opacity: 1;
        transition: transform 0.35s var(--ease-out);
      }

      .gg-product-list-scope .sort-wrapper.is-open .sort-dropdown,
      .gg-product-list-scope .filter-wrapper.is-open .filter-dropdown {
        transform: translateY(0);
      }

      .gg-product-list-scope .sort-dropdown::before,
      .gg-product-list-scope .filter-dropdown::before {
        content: '';
        display: block;
        width: 40px;
        height: 4px;
        background: var(--border);
        border-radius: 10px;
        margin: 0 auto 20px;
      }
    }

    @media (max-width: 480px) {
      .gg-product-list-scope .product-card {
        aspect-ratio: 0.68;
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

    <!-- ── Controls Bar ──────────────────────────── -->
    <div class="controls-bar">

      <!-- Left: Filter Dropdown -->
      <div class="controls-left">
        <div class="filter-wrapper" id="filter-wrapper">
          <button class="filter-btn" id="filter-btn" aria-haspopup="listbox" aria-expanded="false"
            aria-controls="filter-menu">
            <svg class="filter-icon" viewBox="0 0 24 24">
              <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3" />
            </svg>
            <span class="filter-label">Filter:</span>
            <span class="filter-current" id="filter-current-label">All</span>
            <svg class="chevron" viewBox="0 0 24 24">
              <polyline points="6 9 12 15 18 9" />
            </svg>
          </button>

          <div class="filter-dropdown" id="filter-menu" role="listbox" aria-label="Filter by category">

            <!-- All -->
            <button class="filter-option active" role="option" data-filter="all" data-label="All" aria-selected="true">
              <svg viewBox="0 0 24 24">
                <rect x="3" y="3" width="7" height="7" rx="1" />
                <rect x="14" y="3" width="7" height="7" rx="1" />
                <rect x="3" y="14" width="7" height="7" rx="1" />
                <rect x="14" y="14" width="7" height="7" rx="1" />
              </svg>
              All Products
            </button>

            <div class="filter-divider"></div>

            <?php
            $catIcons = [
              'granular' => '<svg viewBox="0 0 24 24"><circle cx="8" cy="8" r="3"/><circle cx="16" cy="8" r="3"/><circle cx="8" cy="16" r="3"/><circle cx="16" cy="16" r="3"/></svg>',
              'liquid' => '<svg viewBox="0 0 24 24"><path d="M12 2C12 2 5 10 5 15a7 7 0 0 0 14 0C19 10 12 2 12 2z"/></svg>',
              'organic' => '<svg viewBox="0 0 24 24"><path d="M12 22V12M12 12C12 7 17 3 21 3c0 4-2 9-9 9zM12 12C12 7 7 3 3 3c0 4 2 9 9 9z"/></svg>',
              'specialty' => '<svg viewBox="0 0 24 24"><path d="M12 2l2.4 7.4H22l-6.2 4.5 2.4 7.4L12 17l-6.2 4.3 2.4-7.4L2 9.4h7.6z"/></svg>',
            ];
            $defaultIcon = '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M2 12h2M20 12h2"/></svg>';
            $categories = array_unique(array_column($products, 'category'));
            foreach ($categories as $cat):
              $count = count(array_filter($products, function ($p) use ($cat) {
                return $p['category'] === $cat; }));
              $icon = isset($catIcons[$cat]) ? $catIcons[$cat] : $defaultIcon;
              ?>
              <button class="filter-option" role="option" data-filter="<?php echo $cat; ?>"
                data-label="<?php echo ucfirst($cat); ?>" aria-selected="false">
                <?php echo $icon; ?>
                <?php echo ucfirst($cat); ?>
              </button>
            <?php endforeach; ?>

          </div>
        </div>
      </div>

      <!-- Right: Sort + Count -->
      <div class="controls-right">

        <!-- Result Count Chip -->
        <span class="product-count-chip" id="product-count-chip">
          <strong id="product-count-num"><?php echo count($products); ?></strong> products
        </span>

        <!-- Sort Dropdown -->
        <div class="sort-wrapper" id="sort-wrapper">
          <button class="sort-btn" id="sort-btn" aria-haspopup="listbox" aria-expanded="false"
            aria-controls="sort-menu">
            <svg class="sort-icon" viewBox="0 0 24 24">
              <line x1="3" y1="6" x2="21" y2="6" />
              <line x1="3" y1="12" x2="15" y2="12" />
              <line x1="3" y1="18" x2="9" y2="18" />
            </svg>
            <span class="sort-label">Sort:</span>
            <span class="sort-current" id="sort-current-label">Default</span>
            <svg class="chevron" viewBox="0 0 24 24">
              <polyline points="6 9 12 15 18 9" />
            </svg>
          </button>

          <div class="sort-dropdown" id="sort-menu" role="listbox" aria-label="Sort options">

            <button class="sort-option active" role="option" data-sort="default" data-label="Default"
              aria-selected="true">
              <svg viewBox="0 0 24 24">
                <path d="M3 12h18M3 6h18M3 18h18" />
              </svg>
              Default Order
            </button>

            <div class="sort-divider"></div>

            <button class="sort-option" role="option" data-sort="az" data-label="A → Z" aria-selected="false">
              <svg viewBox="0 0 24 24">
                <path d="M4 6h7M4 12h5M4 18h9" />
                <path d="M15 6l5 12M20 6l-5 12" />
              </svg>
              Name: A → Z
            </button>

            <button class="sort-option" role="option" data-sort="za" data-label="Z → A" aria-selected="false">
              <svg viewBox="0 0 24 24">
                <path d="M4 6h9M4 12h5M4 18h7" />
                <path d="M15 18l5-12M20 18l-5-12" />
              </svg>
              Name: Z → A
            </button>



          </div>
        </div>
      </div>
    </div>

    <!-- ── Product Grid ──────────────────────────── -->
    <div class="product-grid" id="product-grid">

      <?php
      $idx = 0;
      foreach ($products as $id => $p):
        $idx++;
        $catLabel = ucfirst($p['category']);
        ?>
        <a href="product-view.php?id=<?php echo $id; ?>" class="product-card"
          data-category="<?php echo $p['category']; ?>" data-name="<?php echo htmlspecialchars($p['name']); ?>"
          data-id="<?php echo $id; ?>"
          style="animation-delay: <?php echo $idx * 0.07; ?>s">
          <div class="product-img-wrap">
            <span class="card-badge"><?php echo $catLabel; ?></span>
            <img src="<?php echo $p['image']; ?>" alt="<?php echo $p['name']; ?>" loading="lazy">
          </div>
          <div class="product-info">
            <h3 class="product-name"><?php echo $p['name']; ?></h3>

          </div>
        </a>
      <?php endforeach; ?>

      <!-- No Results -->
      <div class="no-results" id="no-results" aria-live="polite">
        <svg viewBox="0 0 24 24">
          <circle cx="11" cy="11" r="8" />
          <line x1="21" y1="21" x2="16.65" y2="16.65" />
          <line x1="8" y1="11" x2="14" y2="11" />
        </svg>
        <p>No products found in this category.</p>
      </div>
    </div>

  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {

      /* ── Elements ─────────────────────────────── */
      const filterWrapper = document.getElementById('filter-wrapper');
      const filterBtn = document.getElementById('filter-btn');
      const filterCurrentLabel = document.getElementById('filter-current-label');
      const filterOptions = filterWrapper.querySelectorAll('.filter-option');

      const sortWrapper = document.getElementById('sort-wrapper');
      const sortBtn = document.getElementById('sort-btn');
      const sortCurrentLabel = document.getElementById('sort-current-label');
      const sortOptions = sortWrapper.querySelectorAll('.sort-option');

      const grid = document.getElementById('product-grid');
      const cards = Array.from(grid.querySelectorAll('.product-card'));
      const countNum = document.getElementById('product-count-num');
      const noResults = document.getElementById('no-results');

      let currentFilter = 'all';
      let currentSort = 'default';

      /* ── Generic Dropdown Toggle ──────────────── */
      function makeToggle(wrapper, btn, otherWrappers) {
        btn.addEventListener('click', (e) => {
          e.stopPropagation();
          const opening = !wrapper.classList.contains('is-open');
          // close all others first
          otherWrappers.forEach(w => {
            w.classList.remove('is-open');
            w.querySelector('[aria-expanded]').setAttribute('aria-expanded', 'false');
          });
          wrapper.classList.toggle('is-open', opening);
          btn.setAttribute('aria-expanded', String(opening));
        });
        wrapper.addEventListener('keydown', (e) => {
          if (e.key === 'Escape') {
            wrapper.classList.remove('is-open');
            btn.setAttribute('aria-expanded', 'false');
          }
        });
      }

      makeToggle(filterWrapper, filterBtn, [sortWrapper]);
      makeToggle(sortWrapper, sortBtn, [filterWrapper]);

      // Click outside closes all
      document.addEventListener('click', (e) => {
        [filterWrapper, sortWrapper].forEach(w => {
          if (!w.contains(e.target)) {
            w.classList.remove('is-open');
            w.querySelector('[aria-expanded]').setAttribute('aria-expanded', 'false');
          }
        });
      });

      /* ── Sort Logic ───────────────────────────── */
      function applySort() {
        const sorted = [...cards].sort((a, b) => {
          const nameA = a.dataset.name.toLowerCase();
          const nameB = b.dataset.name.toLowerCase();
          switch (currentSort) {
            case 'az': return nameA.localeCompare(nameB);
            case 'za': return nameB.localeCompare(nameA);
            default: return cards.indexOf(a) - cards.indexOf(b);
          }
        });
        sorted.forEach(c => grid.insertBefore(c, noResults));
      }

      sortOptions.forEach(opt => {
        opt.addEventListener('click', () => {
          sortOptions.forEach(o => { o.classList.remove('active'); o.setAttribute('aria-selected', 'false'); });
          opt.classList.add('active');
          opt.setAttribute('aria-selected', 'true');
          currentSort = opt.dataset.sort;
          sortCurrentLabel.textContent = opt.dataset.label;
          applySort();
          applyFilter();
          sortWrapper.classList.remove('is-open');
          sortBtn.setAttribute('aria-expanded', 'false');
        });
      });

      /* ── Filter Logic ─────────────────────────── */
      function applyFilter() {
        let visible = 0;
        cards.forEach(card => {
          const match = currentFilter === 'all' || card.dataset.category === currentFilter;
          card.classList.toggle('hidden', !match);
          if (match) visible++;
        });
        countNum.textContent = visible;
        noResults.classList.toggle('visible', visible === 0);
      }

      filterOptions.forEach(opt => {
        opt.addEventListener('click', () => {
          filterOptions.forEach(o => { o.classList.remove('active'); o.setAttribute('aria-selected', 'false'); });
          opt.classList.add('active');
          opt.setAttribute('aria-selected', 'true');
          currentFilter = opt.dataset.filter;
          filterCurrentLabel.textContent = opt.dataset.label;
          applyFilter();
          filterWrapper.classList.remove('is-open');
          filterBtn.setAttribute('aria-expanded', 'false');
        });
      });

      /* Initial state */
      applySort();
      applyFilter();
    });
  </script>

</section>