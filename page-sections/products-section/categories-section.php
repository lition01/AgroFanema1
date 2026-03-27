<?php // Categories & Search Section — GreenGrow Fertilizers ?>

<section class="gg-cat-scope" aria-label="Product Filtering">
<style>
  /* ══════════════════════════════════════════════════════════
     CATEGORIES & SEARCH SECTION (Scoped)
     Dropdown Filter & Search Integration
  ══════════════════════════════════════════════════════════ */

  .gg-cat-scope {
    --ct-bg:            #0D2117; 
    --ct-surface:       #132D1E;
    --ct-accent:        #C8A84B;
    --ct-text:          #F5F2EA;
    --ct-text-muted:    rgba(245, 242, 234, 0.6);
    --pd-panna:         #F5F2EA;
    --ct-border:        rgba(245, 242, 234, 0.1);
    --ct-font-display:  'Cormorant Garamond', Georgia, serif;
    --ct-font-body:     'Outfit', sans-serif;
    --ct-ease:          cubic-bezier(0.4, 0, 0.2, 1);
    --ct-h-pad:         48px;

    position: relative;
    width: 100%;
    background: var(--ct-bg);
    font-family: var(--ct-font-body);
    color: var(--ct-text);
    padding: 140px 0 60px; /* Navbar clearance */
    border-bottom: 1px solid var(--ct-border);
    z-index: 10;
  }

  .gg-cat-scope *,
  .gg-cat-scope *::before,
  .gg-cat-scope *::after {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }

  .gg-cat-scope .ct-inner {
    position: relative;
    z-index: 5;
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 var(--ct-h-pad);
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 32px;
  }

  /* ── Left Side: Search ────────────────────────────────── */
  .gg-cat-scope .ct-left {
    flex: 1;
    max-width: 400px;
  }

  .gg-cat-scope .ct-search-wrap {
    position: relative;
    width: 100%;
  }

  .gg-cat-scope .ct-search-input {
    width: 100%;
    background: var(--ct-surface);
    border: 1px solid var(--ct-border);
    border-radius: 12px;
    padding: 14px 20px 14px 48px;
    color: var(--ct-text);
    font-family: var(--ct-font-body);
    font-size: 0.95rem;
    transition: all 0.3s var(--ct-ease);
  }

  .gg-cat-scope .ct-search-input:focus {
    outline: none;
    border-color: var(--ct-accent);
    background: #173624;
  }

  .gg-cat-scope .ct-search-icon {
    position: absolute;
    left: 18px; top: 50%;
    transform: translateY(-50%);
    width: 18px; height: 18px;
    stroke: var(--ct-accent);
    stroke-width: 2.5;
    fill: none;
  }

  /* ── Right Side: Filter Dropdown ────────────────────────── */
  .gg-cat-scope .ct-right {
    position: relative;
    display: flex;
    gap: 12px;
  }

  /* Filter System Button */
  .gg-cat-scope .ct-system-toggle {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    padding: 14px 24px;
    background: var(--ct-accent);
    border: none;
    border-radius: 10px;
    color: var(--ct-bg);
    font-size: 0.85rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    cursor: pointer;
    transition: all 0.3s var(--ct-ease);
  }

  .gg-cat-scope .ct-system-toggle:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(200, 168, 75, 0.2);
  }

  .gg-cat-scope .ct-system-toggle svg {
    width: 18px; height: 18px;
    stroke: currentColor;
    stroke-width: 2.5;
    fill: none;
    transition: transform 0.4s var(--ct-ease);
  }

  .gg-cat-scope .ct-system-toggle.is-active svg {
    transform: rotate(180deg);
  }

  /* Categories Dropdown (Initially Hidden) */
  .gg-cat-scope .ct-categories-wrap {
    position: relative;
    display: none; /* Controlled by JS */
    opacity: 0;
    transform: translateX(10px);
    transition: all 0.4s var(--ct-ease);
  }

  .gg-cat-scope .ct-categories-wrap.is-visible {
    display: block;
    opacity: 1;
    transform: translateX(0);
  }

  .gg-cat-scope .ct-filter-toggle {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    padding: 14px 24px;
    background: var(--ct-surface);
    border: 1px solid var(--ct-border);
    border-radius: 10px;
    color: var(--ct-text);
    font-size: 0.85rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s var(--ct-ease);
    min-width: 180px;
    justify-content: space-between;
  }

  .gg-cat-scope .ct-filter-toggle:hover {
    border-color: var(--ct-accent);
  }

  .gg-cat-scope .ct-filter-toggle svg {
    width: 16px; height: 16px;
    stroke: var(--ct-accent);
    stroke-width: 2.5;
    fill: none;
    transition: transform 0.3s ease;
  }

  .gg-cat-scope .ct-filter-toggle.is-active svg {
    transform: rotate(180deg);
  }

  /* Dropdown Menu */
  .gg-cat-scope .ct-dropdown {
    position: absolute;
    top: calc(100% + 12px);
    right: 0;
    width: 240px;
    background: #FFFFFF;
    border-radius: 12px;
    padding: 8px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
    border: 1px solid var(--ct-border);
    opacity: 0;
    visibility: hidden;
    transform: translateY(10px);
    transition: all 0.3s var(--ct-ease);
    z-index: 100;
  }

  .gg-cat-scope .ct-dropdown.is-open {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
  }

  .gg-cat-scope .ct-drop-btn {
    width: 100%;
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 16px;
    border: none;
    background: transparent;
    border-radius: 8px;
    color: #1A3329;
    font-family: var(--ct-font-body);
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    text-align: left;
    transition: all 0.2s ease;
  }

  .gg-cat-scope .ct-drop-btn:hover {
    background: #F5F2EA;
    color: var(--ct-accent);
  }

  .gg-cat-scope .ct-drop-btn.active {
    background: #1A3329;
    color: #FFFFFF;
  }

  .gg-cat-scope .ct-drop-btn svg {
    width: 16px; height: 16px;
    stroke: currentColor;
    stroke-width: 2;
    fill: none;
  }

  /* ── Responsive ── */
  @media (max-width: 768px) {
    .gg-cat-scope .ct-inner { flex-direction: column; align-items: stretch; gap: 20px; }
    .gg-cat-scope .ct-left { max-width: 100%; }
    .gg-cat-scope .ct-dropdown { width: 100%; }
  }
</style>

  <div class="ct-inner">
    <!-- Search -->
    <div class="ct-left">
      <div class="ct-search-wrap">
        <svg class="ct-search-icon" viewBox="0 0 24 24"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
        <input type="text" class="ct-search-input" id="productSearch" placeholder="Search our catalog..." />
      </div>
    </div>

    <!-- Filter Dropdown -->
    <div class="ct-right">
      <button class="ct-system-toggle" id="systemToggle">
        <svg viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
        <span>Filter System</span>
      </button>

      <div class="ct-categories-wrap" id="categoriesWrap">
        <button class="ct-filter-toggle" id="filterToggle">
          <span>All Categories</span>
          <svg viewBox="0 0 24 24"><path d="m6 9 6 6 6-6"/></svg>
        </button>

        <div class="ct-dropdown" id="filterDropdown">
          <button class="ct-drop-btn active" data-filter="all">
            <svg viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/></svg>
            All Categories
          </button>
          <button class="ct-drop-btn" data-filter="granular">
            <svg viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
            Granular
          </button>
          <button class="ct-drop-btn" data-filter="liquid">
            <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
            Liquid
          </button>
          <button class="ct-drop-btn" data-filter="soil-health">
            <svg viewBox="0 0 24 24"><path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.48 19 2c1 2 2 4.18 2 8a7 7 0 0 1-10 10z"/><path d="M2 21c0-3 1.85-5.36 5.08-6C9.5 14.52 12 13 13 12"/></svg>
            Soil Health
          </button>
          <button class="ct-drop-btn" data-filter="specialty">
            <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06-.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"/></svg>
            Specialty
          </button>
        </div>
      </div>
    </div>
  </div>

  <script>
    (function() {
      const scope = document.querySelector('.gg-cat-scope');
      if (!scope) return;
      
      const systemToggle = scope.querySelector('#systemToggle');
      const categoriesWrap = scope.querySelector('#categoriesWrap');
      const filterToggle = scope.querySelector('#filterToggle');
      const filterDropdown = scope.querySelector('#filterDropdown');
      const buttons = scope.querySelectorAll('.ct-drop-btn');
      const searchInput = scope.querySelector('#productSearch');

      // 1. Toggle Filter System (Show/Hide Categories)
      systemToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        const isVisible = categoriesWrap.classList.contains('is-visible');
        
        if (!isVisible) {
          categoriesWrap.style.display = 'block';
          // Small timeout to allow display:block to hit the DOM before opacity transition
          setTimeout(() => {
            categoriesWrap.classList.add('is-visible');
            systemToggle.classList.add('is-active');
          }, 10);
        } else {
          categoriesWrap.classList.remove('is-visible');
          systemToggle.classList.remove('is-active');
          // Hide after transition
          setTimeout(() => {
            if (!categoriesWrap.classList.contains('is-visible')) {
              categoriesWrap.style.display = 'none';
            }
          }, 400);
        }
      });

      // 2. Toggle Categories Dropdown
      filterToggle.addEventListener('click', (e) => {
        e.stopPropagation();
        const isOpen = filterDropdown.classList.contains('is-open');
        filterDropdown.classList.toggle('is-open', !isOpen);
        filterToggle.classList.toggle('is-active', !isOpen);
      });

      // 3. Close everything on outside click
      document.addEventListener('click', (e) => {
        if (!scope.contains(e.target)) {
          filterDropdown.classList.remove('is-open');
          filterToggle.classList.remove('is-active');
        }
      });

      // 4. Filtering Logic
      buttons.forEach(btn => {
        btn.addEventListener('click', () => {
          buttons.forEach(b => b.classList.remove('active'));
          btn.classList.add('active');
          
          // Update toggle text
          const catName = btn.textContent.trim();
          filterToggle.querySelector('span').textContent = catName;
          
          // Close dropdown after selection
          filterDropdown.classList.remove('is-open');
          filterToggle.classList.remove('is-active');
          
          triggerUpdate();
        });
      });

      // 5. Search Logic
      searchInput.addEventListener('input', () => {
        triggerUpdate();
      });

      function triggerUpdate() {
        const activeBtn = scope.querySelector('.ct-drop-btn.active');
        const filter = activeBtn ? activeBtn.getAttribute('data-filter') : 'all';
        const search = searchInput.value.toLowerCase();
        
        const event = new CustomEvent('gg-product-filter', { 
          detail: { 
            filter: filter,
            search: search 
          } 
        });
        window.dispatchEvent(event);
      }
    })();
  </script>
</section>