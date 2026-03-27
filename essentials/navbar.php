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
      --gg-nav-h:            78px;
      --gg-nav-font-display: 'Cormorant Garamond', Georgia, serif;
      --gg-nav-font-body:    'Outfit', sans-serif;
      --gg-nav-ease:         cubic-bezier(0.4, 0, 0.2, 1);
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
      padding: 0 48px;
      z-index: 1000;
      font-family: var(--gg-nav-font-body);
      
      /* Entrance Animation Styles */
      transform: translateY(-100%);
      opacity: 0;
      transition: transform 0.8s var(--gg-nav-ease), opacity 0.8s var(--gg-nav-ease);
    }

    /* Active state for entrance animation */
    .gg-nav-scope .navbar.is-visible {
      transform: translateY(0);
      opacity: 1;
    }

    .gg-nav-scope .navbar::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0;
      height: 2px;
      background: var(--gg-nav-accent);
    }

    .gg-nav-scope .logo {
      display: flex;
      align-items: center;
      gap: 0;
      text-decoration: none;
      flex-shrink: 0;
    }


    .gg-nav-scope .logo-img {
      width: var(--gg-nav-h);
      height: var(--gg-nav-h);
      display: flex;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      border-radius: 0;
      background: none;
      transition: transform 0.25s var(--gg-nav-ease);
    }

    .gg-nav-scope .logo:hover .logo-img {
      transform: scale(1.05);
    }

    .gg-nav-scope .logo-img img,
    .gg-nav-scope .logo-img svg {
      width: 100%;
      height: 100%;
      object-fit: contain;
      display: block;
      position: relative;
      z-index: 1;
    }

    .gg-nav-scope .logo-img img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      display: block;
      position: relative;
      z-index: 1;
    }

    .gg-nav-scope .logo-text {
      display: flex;
      flex-direction: column;
      line-height: 1.15;
    }

    .gg-nav-scope .logo-name {
      font-family: var(--gg-nav-font-display);
      font-size: 1.3rem;
      font-weight: 700;
      color: var(--gg-nav-primary);
      letter-spacing: 0.02em;
    }

    .gg-nav-scope .logo-name span { color: var(--gg-nav-accent); }

    .gg-nav-scope .logo-sub {
      font-size: 0.6rem;
      font-weight: 500;
      letter-spacing: 0.18em;
      text-transform: uppercase;
      color: var(--gg-nav-text-muted);
    }

    .gg-nav-scope .nav-links {
      display: flex;
      align-items: center;
      gap: 2px;
      list-style: none;
    }

    .gg-nav-scope .nav-links a {
      display: flex;
      align-items: center;
      gap: 7px;
      text-decoration: none;
      color: var(--gg-nav-text-muted);
      font-weight: 500;
      font-size: 0.875rem;
      letter-spacing: 0.03em;
      padding: 8px 15px;
      border-radius: 6px;
      position: relative;
      transition: color 0.25s var(--gg-nav-ease), background 0.25s var(--gg-nav-ease);
    }

    .gg-nav-scope .nav-links a svg {
      width: 14px; height: 14px;
      stroke: var(--gg-nav-primary-mid);
      opacity: 0.6;
      flex-shrink: 0;
      transition: opacity 0.25s, stroke 0.25s;
    }

    .gg-nav-scope .nav-links a:hover {
      color: var(--gg-nav-primary);
    }

    .gg-nav-scope .nav-links a:hover svg { opacity: 1; stroke: var(--gg-nav-primary); }

    .gg-nav-scope .nav-links a.active {
      color: var(--gg-nav-primary);
      font-weight: 600;
    }

    .gg-nav-scope .nav-links a::after {
      content: '';
      position: absolute;
      bottom: 4px; left: 15px; right: 15px;
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
      padding: 9px 20px;
      border-radius: 6px;
      font-weight: 600;
      letter-spacing: 0.05em;
      font-size: 0.8rem;
      text-transform: uppercase;
      margin-left: 10px;
      transition: background 0.25s var(--gg-nav-ease), box-shadow 0.25s var(--gg-nav-ease), transform 0.2s var(--gg-nav-ease);
    }

    .gg-nav-scope .nav-links .nav-cta svg { stroke: rgba(200,168,75,.9); opacity: 1; }
    .gg-nav-scope .nav-links .nav-cta::after { display: none; }

    .gg-nav-scope .nav-links .nav-cta:hover {
      background: var(--gg-nav-primary-mid);
      color: var(--gg-nav-neutral);
      box-shadow: 0 6px 20px var(--gg-nav-shadow-md);
      transform: translateY(-1px);
    }

    .gg-nav-scope .burger-btn {
      display: none;
      width: 44px; height: 44px;
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
      width: 24px; height: 24px;
      overflow: visible;
    }

    .gg-nav-scope .burger-svg .b-top,
    .gg-nav-scope .burger-svg .b-mid,
    .gg-nav-scope .burger-svg .b-bot {
      stroke: var(--gg-nav-primary);
      stroke-width: 1.6;
      stroke-linecap: round;
      transform-origin: 12px 12px;
      transition:
        transform 0.4s cubic-bezier(0.77, 0, 0.175, 1),
        opacity   0.3s var(--gg-nav-ease),
        stroke    0.25s var(--gg-nav-ease),
        stroke-width 0.25s var(--gg-nav-ease);
    }

    .gg-nav-scope .burger-svg .b-top { transform: translateY(-6px); }
    .gg-nav-scope .burger-svg .b-mid { transform: translateY(0px); }
    .gg-nav-scope .burger-svg .b-bot { transform: translateY(6px); }

    .gg-nav-scope .burger-btn.active .burger-svg .b-top,
    .gg-nav-scope .burger-btn.active .burger-svg .b-bot {
      stroke: var(--gg-nav-accent);
      stroke-width: 2;
    }

    .gg-nav-scope .burger-btn.active .burger-svg .b-top {
      transform: translateY(0) rotate(45deg);
    }
    .gg-nav-scope .burger-btn.active .burger-svg .b-mid {
      opacity: 0;
      transform: scaleX(0);
      stroke: var(--gg-nav-accent);
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
        padding: 0 24px;
        justify-content: flex-start;
      }
      .gg-nav-scope .logo {
        margin-right: auto;
      }
      .gg-nav-scope .nav-links { display: none; }
      .gg-nav-scope .burger-btn { display: flex; }
    }

    @media (max-width: 480px) {
      .gg-nav-scope .logo-sub { display: none; }
      .gg-nav-scope .dropdown-inner { padding: 24px 20px 28px; }
    }
  </style>

  <nav class="navbar" id="navbar">
    <a href="index.php" class="logo" aria-label="GreenGrow Home">
      <div class="logo-img">
        <!-- Place your logo image or SVG below -->
        <img src="images/logo.svg" alt="GreenGrow Logo" />
        <!-- Or use an inline SVG instead of <img> if you prefer -->
        <!-- <svg ...>...</svg> -->
      </div>
      <div class="logo-text">
        <span class="logo-name">AgroFanema</span>
      </div>
    </a>

    <ul class="nav-links">
      <li>
        <a href="index.php" class="active">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
          Home
        </a>
      </li>
      <li>
        <a href="products.php">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
          Products
        </a>
      </li>
      <li>
        <a href="#">
          <svg viewBox="0 0 24 24" fill="none" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
          About
        </a>
      </li>
      <li>
        <a href="#" class="nav-cta">Contact</a>
      </li>
    </ul>

    <button class="burger-btn" id="burgerBtn" aria-label="Toggle menu" aria-expanded="false">
      <svg class="burger-svg" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <line class="b-top" x1="2" y1="12" x2="22" y2="12"/>
        <line class="b-mid" x1="2" y1="12" x2="22" y2="12"/>
        <line class="b-bot" x1="2" y1="12" x2="22" y2="12"/>
      </svg>
    </button>
  </nav>

  <div class="dropdown-menu" id="dropdownMenu" role="navigation" aria-label="Mobile navigation">
    <div class="dropdown-inner">
      <ul>
        <li><a href="index.php" class="active">Home</a></li>
        <li><a href="products.php">Products</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Contact</a></li>
      </ul>
    </div>
  </div>

  <script>
    (function() {
      const navbar       = document.getElementById('navbar');
      const burgerBtn    = document.getElementById('burgerBtn');
      const dropdownMenu = document.getElementById('dropdownMenu');

      /* Entrance transition on load */
      window.addEventListener('load', () => {
        setTimeout(() => {
          navbar.classList.add('is-visible');
        }, 100);
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

      document.addEventListener('click', e => {
        if (!dropdownMenu.contains(e.target) && !burgerBtn.contains(e.target)) closeMenu();
      });

      document.addEventListener('keydown', e => { if (e.key === 'Escape') closeMenu(); });

      document.querySelectorAll('.dropdown-menu a').forEach(link => {
        link.addEventListener('click', closeMenu);
      });
    })();
  </script>
</div>