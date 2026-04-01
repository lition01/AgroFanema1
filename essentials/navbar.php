<div class="gg-nav-scope">
  <style>
    /* ═══════════════════════════════════════════════
       NAVBAR (Scoped to .gg-nav-scope)
    ═══════════════════════════════════════════════ */
    .gg-nav-scope {
      --gg-nav-primary:      #1A3329;
      --gg-nav-primary-mid:  #2E5A48;
      --gg-nav-accent:       #C8A84B;
      --gg-nav-neutral:      #F5F2EA;
      --gg-nav-bg:           #F5F2EA;
      --gg-nav-text:         #1A1A1A;
      --gg-nav-text-muted:   #6B6B62;
      --gg-nav-border:       #E2E0DA;
      --gg-nav-shadow-md:    rgba(26, 51, 41, 0.13);
      --gg-nav-h:            68px; /* Reduced from 78px */
      --gg-nav-font-display: 'Cormorant Garamond', Georgia, serif;
      --gg-nav-font-body:    'Outfit', sans-serif;
      --gg-nav-ease:         cubic-bezier(0.4, 0, 0.2, 1);
    }

    /* Global padding to offset the fixed navbar */
    body {
      padding-top: 68px;
    }

    .gg-nav-scope .navbar {
      position: fixed;
      top: 0; left: 0; right: 0;
      height: var(--gg-nav-h);
      background: var(--gg-nav-neutral);
      border-bottom: 1px solid var(--gg-nav-border);
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 0 32px;
      z-index: 1000;
      font-family: var(--gg-nav-font-body);
    }

    /* Coordinated Entrance */
    .gg-nav-scope .logo,
    .gg-nav-scope .nav-right,
    .gg-nav-scope .burger-btn {
      opacity: 0;
      transform: translateY(-15px);
      filter: blur(4px);
      transition: 
        opacity 1s cubic-bezier(0.19, 1, 0.22, 1), 
        transform 1s cubic-bezier(0.19, 1, 0.22, 1),
        filter 1s cubic-bezier(0.19, 1, 0.22, 1);
    }

    .gg-nav-scope .navbar.is-visible .logo,
    .gg-nav-scope .navbar.is-visible .nav-right,
    .gg-nav-scope .navbar.is-visible .burger-btn {
      opacity: 1;
      transform: translateY(0);
      filter: blur(0);
    }

    .gg-nav-scope .navbar.is-visible .logo { transition-delay: 0.2s; }
    .gg-nav-scope .navbar.is-visible .nav-right { transition-delay: 0.4s; }
    .gg-nav-scope .navbar.is-visible .burger-btn { transition-delay: 0.4s; }

    .gg-nav-scope .logo {
      display: flex;
      align-items: center;
      gap: 0;
      text-decoration: none;
      flex-shrink: 0;
    }

    .gg-nav-scope .logo-img {
      width: 72px;
      height: 72px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-left: -8px;
      transition: transform 0.35s var(--gg-nav-ease);
    }

    .gg-nav-scope .logo:hover .logo-img { transform: scale(1.04); }

    .gg-nav-scope .logo-img img,
    .gg-nav-scope .logo-img svg {
      width: 100%;
      height: 100%;
      object-fit: contain;
    }

    .gg-nav-scope .logo-text {
      display: flex;
      flex-direction: column;
      line-height: 1.15;
      margin-left: -10px;
    }

    .gg-nav-scope .logo-name {
      font-family: var(--gg-nav-font-display);
      font-size: 1.2rem;
      font-weight: 700;
      color: var(--gg-nav-primary);
      letter-spacing: 0.02em;
      transition: color 0.3s var(--gg-nav-ease);
    }

    .gg-nav-scope .logo:hover .logo-name { color: var(--gg-nav-accent); }
    .gg-nav-scope .logo-name span { color: var(--gg-nav-accent); }

    /* ── Right Content Group ─────────────────── */
    .gg-nav-scope .nav-right {
      display: flex;
      align-items: center;
      gap: 24px;
      margin-left: auto;
    }

    .gg-nav-scope .nav-links {
      display: flex;
      align-items: center;
      gap: 4px;
      list-style: none;
    }

    .gg-nav-scope .nav-links a {
      text-decoration: none;
      color: #000000;
      font-weight: 700;
      font-size: 0.95rem;
      letter-spacing: 0.03em;
      padding: 6px 12px;
      position: relative;
      transition: color 0.25s var(--gg-nav-ease);
    }

    .gg-nav-scope .nav-links a:hover { color: var(--gg-nav-primary); }

    .gg-nav-scope .nav-links a::after {
      content: '';
      position: absolute;
      bottom: 0; left: 12px; right: 12px;
      height: 1.5px;
      background: var(--gg-nav-accent);
      transform: scaleX(0);
      transform-origin: left;
      transition: transform 0.3s var(--gg-nav-ease);
    }

    .gg-nav-scope .nav-links a:hover::after,
    .gg-nav-scope .nav-links a.active::after { transform: scaleX(1); }

    .gg-nav-scope .nav-links .nav-cta {
      background: var(--gg-nav-primary);
      color: var(--gg-nav-neutral);
      padding: 8px 20px;
      border-radius: 100px;
      font-weight: 600;
      text-transform: uppercase;
      font-size: 0.75rem;
      margin-left: 8px;
      transition: background 0.25s var(--gg-nav-ease);
    }

    .gg-nav-scope .nav-links .nav-cta::after { display: none; }
    .gg-nav-scope .nav-links .nav-cta:hover { 
      background: var(--gg-nav-accent); 
      color: var(--gg-nav-primary);
    }

    .gg-nav-scope .nav-links .nav-cta.active {
      background: var(--gg-nav-accent);
      color: var(--gg-nav-primary);
    }

    /* ── Language Dropdown ────────────────────── */
    .gg-nav-scope .lang-selector {
      position: relative;
      display: flex;
      align-items: center;
    }

    .gg-nav-scope .lang-btn {
      background: none;
      border: 1px solid var(--gg-nav-border);
      padding: 5px 12px;
      border-radius: 100px;
      font-size: 0.7rem;
      font-weight: 600;
      color: var(--gg-nav-text-muted);
      cursor: pointer;
      display: flex;
      align-items: center;
      gap: 4px;
      transition: all 0.3s var(--gg-nav-ease);
    }

    .gg-nav-scope .lang-btn:hover {
      border-color: var(--gg-nav-accent);
      background: rgba(200, 168, 75, 0.05);
    }

    .gg-nav-scope .lang-btn svg {
      width: 12px; height: 12px;
      stroke: currentColor;
      stroke-width: 2;
      fill: none;
      transition: transform 0.3s var(--gg-nav-ease);
    }

    .gg-nav-scope .lang-selector.is-open .lang-btn svg { transform: rotate(180deg); }

    .gg-nav-scope .lang-dropdown {
      position: absolute;
      top: calc(100% + 8px);
      right: 0;
      background: var(--gg-nav-neutral);
      border: 1px solid var(--gg-nav-border);
      border-radius: 10px;
      min-width: 110px;
      padding: 6px;
      box-shadow: 0 8px 24px rgba(26, 51, 41, 0.08);
      opacity: 0;
      visibility: hidden;
      transform: translateY(8px);
      transition: all 0.3s var(--gg-nav-ease);
      z-index: 1002;
    }

    .gg-nav-scope .lang-selector.is-open .lang-dropdown {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }

    .gg-nav-scope .lang-option {
      display: block;
      width: 100%;
      padding: 6px 10px;
      border-radius: 6px;
      text-decoration: none;
      color: var(--gg-nav-text-muted);
      font-size: 0.75rem;
      font-weight: 500;
      text-align: left;
      border: none;
      background: none;
      cursor: pointer;
      transition: all 0.2s var(--gg-nav-ease);
    }

    .gg-nav-scope .lang-option:hover {
      background: rgba(200, 168, 75, 0.1);
      color: var(--gg-nav-primary);
    }

    .gg-nav-scope .lang-option.active {
      background: var(--gg-nav-primary);
      color: var(--gg-nav-neutral);
    }

    .gg-nav-scope .burger-btn {
      display: none;
      width: 44px;
      height: 44px;
      background: none;
      border: none;
      cursor: pointer;
      position: relative;
      z-index: 1001;
      padding: 0;
      align-items: center;
      justify-content: center;
    }

    .gg-nav-scope .burger-svg {
      width: 24px;
      height: 24px;
      overflow: visible;
    }

    /* ── Burger Menu Symmetrical Fix ─────────── */
    .gg-nav-scope .burger-svg .b-top,
    .gg-nav-scope .burger-svg .b-mid,
    .gg-nav-scope .burger-svg .b-bot {
      stroke: var(--gg-nav-primary);
      stroke-width: 1.8;
      stroke-linecap: round;
      transform-origin: center;
      transition:
        transform 0.4s cubic-bezier(0.4, 0, 0.2, 1),
        opacity   0.3s var(--gg-nav-ease),
        stroke    0.3s var(--gg-nav-ease);
    }

    .gg-nav-scope .burger-svg .b-top { transform: translateY(-7px); }
    .gg-nav-scope .burger-svg .b-mid { transform: translateY(0); }
    .gg-nav-scope .burger-svg .b-bot { transform: translateY(7px); }

    .gg-nav-scope .burger-btn.active .burger-svg .b-top {
      transform: translateY(0) rotate(45deg);
    }
    .gg-nav-scope .burger-btn.active .burger-svg .b-mid {
      opacity: 0;
    }
    .gg-nav-scope .burger-btn.active .burger-svg .b-bot {
      transform: translateY(0) rotate(-45deg);
    }

    .gg-nav-scope .dropdown-menu {
      position: fixed;
      top: var(--gg-nav-h);
      left: 0; width: 100%;
      max-height: 0;
      background: var(--gg-nav-neutral);
      border-bottom: 2px solid var(--gg-nav-accent);
      overflow: hidden;
      opacity: 0;
      visibility: hidden;
      transition:
        max-height 0.5s cubic-bezier(0.77, 0, 0.175, 1),
        opacity 0.3s var(--gg-nav-ease),
        visibility 0.3s var(--gg-nav-ease);
      z-index: 999;
      box-shadow: 0 20px 60px rgba(26,51,41,.15);
    }

    .gg-nav-scope .dropdown-menu.active {
      max-height: 420px;
      opacity: 1;
      visibility: visible;
    }

    .gg-nav-scope .dropdown-inner {
      padding: 28px 32px 36px;
      display: grid;
      grid-template-columns: 1fr;
      gap: 0;
    }

    .gg-nav-scope .dropdown-menu ul {
      list-style: none;
      display: flex;
      flex-direction: column;
      gap: 0;
    }

    .gg-nav-scope .dropdown-menu li {
      opacity: 0;
      transform: translateX(-12px);
      transition: opacity 0.35s var(--gg-nav-ease), transform 0.35s var(--gg-nav-ease);
      border-bottom: 1px solid var(--gg-nav-border);
    }

    .gg-nav-scope .dropdown-menu li:last-child { border-bottom: none; }

    .gg-nav-scope .dropdown-menu.active li { opacity: 1; transform: translateX(0); }
    .gg-nav-scope .dropdown-menu.active li:nth-child(1) { transition-delay: 0.06s; }
    .gg-nav-scope .dropdown-menu.active li:nth-child(2) { transition-delay: 0.11s; }
    .gg-nav-scope .dropdown-menu.active li:nth-child(3) { transition-delay: 0.16s; }
    .gg-nav-scope .dropdown-menu.active li:nth-child(4) { transition-delay: 0.21s; }
    .gg-nav-scope .dropdown-menu.active li:nth-child(5) { transition-delay: 0.26s; }

    .gg-nav-scope .dropdown-menu .lang-mobile {
      margin-top: 24px;
      padding-top: 24px;
      border-top: 1px solid var(--gg-nav-border);
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .gg-nav-scope .dropdown-menu .lang-mobile-title {
      font-size: 0.7rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.15em;
      color: var(--gg-nav-accent);
      margin-bottom: 4px;
    }

    .gg-nav-scope .dropdown-menu .lang-mobile-options {
      display: flex;
      gap: 8px;
      flex-wrap: wrap;
    }

    .gg-nav-scope .dropdown-menu .lang-mobile-btn {
      padding: 8px 16px;
      border-radius: 100px;
      border: 1px solid var(--gg-nav-border);
      background: none;
      font-family: var(--gg-nav-font-body);
      font-size: 0.8rem;
      font-weight: 600;
      color: var(--gg-nav-text-muted);
      cursor: pointer;
      transition: all 0.3s var(--gg-nav-ease);
    }

    .gg-nav-scope .dropdown-menu .lang-mobile-btn.active {
      background: var(--gg-nav-primary);
      color: var(--gg-nav-neutral);
      border-color: var(--gg-nav-primary);
    }

    .gg-nav-scope .dropdown-menu a {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 18px 4px;
      text-decoration: none;
      color: var(--gg-nav-text-muted);
      font-family: var(--gg-nav-font-display);
      font-size: 1.4rem;
      font-weight: 600;
      letter-spacing: 0.01em;
      position: relative;
      transition: color 0.22s var(--gg-nav-ease), padding-left 0.22s var(--gg-nav-ease);
    }

    .gg-nav-scope .dropdown-menu a:hover,
    .gg-nav-scope .dropdown-menu a.active {
      color: var(--gg-nav-primary);
      padding-left: 8px;
    }

    @media (max-width: 992px) {
      .gg-nav-scope .navbar {
        padding: 0 20px;
        justify-content: flex-start;
      }
      .gg-nav-scope .logo {
        margin-right: auto;
      }
      .gg-nav-scope .nav-right { display: none; }
      .gg-nav-scope .burger-btn { display: flex; }
    }

    @media (max-width: 480px) {
      .gg-nav-scope .logo-sub { display: none; }
      .gg-nav-scope .dropdown-inner { padding: 24px 20px 28px; }
    }
  </style>

  <?php 
    require_once "translations.php";
    $current_page = basename($_SERVER['PHP_SELF']); 
  ?>
  <nav class="navbar" id="navbar">
    <a href="index.php" class="logo" aria-label="AgroFanema Home">
      <div class="logo-img">
        <img src="images/logo.svg" alt="AgroFanema Logo" />
      </div>
      <div class="logo-text">
        <span class="logo-name">AgroFanema</span>
      </div>
    </a>

    <div class="nav-right">
      <ul class="nav-links">
        <li>
          <a href="index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
            <?php echo t('home'); ?>
          </a>
        </li>
        <li>
          <a href="products.php" class="<?php echo ($current_page == 'products.php') ? 'active' : ''; ?>">
            <?php echo t('products'); ?>
          </a>
        </li>
        <li>
          <a href="about.php" class="<?php echo ($current_page == 'about.php') ? 'active' : ''; ?>">
            <?php echo t('about'); ?>
          </a>
        </li>
        <li>
          <a href="contact.php" class="nav-cta <?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>">
            <?php echo t('contact'); ?>
          </a>
        </li>
      </ul>

      <div class="lang-selector" id="langSelector">
        <button class="lang-btn" id="langBtn">
          <?php echo strtoupper($lang); ?>
          <svg viewBox="0 0 24 24"><path d="M6 9l6 6 6-6"/></svg>
        </button>
        <div class="lang-dropdown">
          <button class="lang-option <?php echo ($lang == 'en') ? 'active' : ''; ?>" data-lang="en">English (EN)</button>
          <button class="lang-option <?php echo ($lang == 'sq') ? 'active' : ''; ?>" data-lang="sq">Shqip (AL)</button>
        </div>
      </div>
    </div>

    <button class="burger-btn" id="burgerBtn" aria-label="Toggle menu" aria-expanded="false">
      <svg class="burger-svg" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <line class="b-top" x1="2" y1="12" x2="22" y2="12"/>
        <line class="b-mid" x1="5" y1="12" x2="19" y2="12"/>
        <line class="b-bot" x1="2" y1="12" x2="22" y2="12"/>
      </svg>
    </button>
  </nav>

  <div class="dropdown-menu" id="dropdownMenu" role="navigation" aria-label="Mobile navigation">
    <div class="dropdown-inner">
      <ul>
        <li><a href="index.php" class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>"><?php echo t('home'); ?></a></li>
        <li><a href="products.php" class="<?php echo ($current_page == 'products.php') ? 'active' : ''; ?>"><?php echo t('products'); ?></a></li>
        <li><a href="about.php" class="<?php echo ($current_page == 'about.php') ? 'active' : ''; ?>"><?php echo t('about'); ?></a></li>
        <li><a href="contact.php" class="<?php echo ($current_page == 'contact.php') ? 'active' : ''; ?>"><?php echo t('contact'); ?></a></li>
        <li class="lang-mobile">
          <span class="lang-mobile-title"><?php echo t('select_language'); ?></span>
          <div class="lang-mobile-options">
            <button class="lang-mobile-btn <?php echo ($lang == 'en') ? 'active' : ''; ?>" data-lang="en">English</button>
            <button class="lang-mobile-btn <?php echo ($lang == 'sq') ? 'active' : ''; ?>" data-lang="sq">Shqip</button>
          </div>
        </li>
      </ul>
    </div>
  </div>

  <script>
    (function() {
      const navbar       = document.getElementById('navbar');
      const burgerBtn    = document.getElementById('burgerBtn');
      const dropdownMenu = document.getElementById('dropdownMenu');
      const langSelector = document.getElementById('langSelector');
      const langBtn      = document.getElementById('langBtn');

      /* Entrance transition on load */
      window.addEventListener('load', () => {
        setTimeout(() => {
          navbar.classList.add('is-visible');
        }, 50);
      });

      function toggleMenu() {
        const isOpen = dropdownMenu.classList.contains('active');
        dropdownMenu.classList.toggle('active');
        burgerBtn.classList.toggle('active');
        burgerBtn.setAttribute('aria-expanded', String(!isOpen));
      }

      function closeMenu() {
        dropdownMenu.classList.remove('active');
        burgerBtn.classList.remove('active');
        burgerBtn.setAttribute('aria-expanded', 'false');
      }

      burgerBtn.addEventListener('click', e => { e.stopPropagation(); toggleMenu(); });

      // Language Dropdown Toggle
      langBtn.addEventListener('click', (e) => {
        e.stopPropagation();
        langSelector.classList.toggle('is-open');
      });

      // Language Selection
      document.querySelectorAll('.lang-option, .lang-mobile-btn').forEach(btn => {
        btn.addEventListener('click', () => {
          const selectedLang = btn.getAttribute('data-lang');
          document.cookie = `lang=${selectedLang}; path=/; max-age=${60*60*24*30}`;
          window.location.reload();
        });
      });

      document.addEventListener('click', e => {
        if (!dropdownMenu.contains(e.target) && !burgerBtn.contains(e.target)) closeMenu();
        if (!langSelector.contains(e.target)) langSelector.classList.remove('is-open');
      });

      document.addEventListener('keydown', e => { 
        if (e.key === 'Escape') {
          closeMenu();
          langSelector.classList.remove('is-open');
        }
      });

      document.querySelectorAll('.dropdown-menu a').forEach(link => {
        link.addEventListener('click', closeMenu);
      });
    })();
  </script>
</div>