<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="https://public-frontend-cos.metadl.com/mgx/img/favicon_atoms.ico" type="image/x-icon">
    <title>AgroFanema — GreenGrow Fertilizers</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
   <style>
/* ══════════════════════════════════════════
   GLOBAL RESET & PAGE STYLES
══════════════════════════════════════════ */
*,
*::before,
*::after {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html, body {
    min-height: 100vh;
    font-family: 'Outfit', sans-serif;
    background: #0D2117;
    color: #FFFFFF;
}

body {
    display: flex;
    flex-direction: column;
}

/* ══════════════════════════════════════════
   FOOTER (Scoped)
══════════════════════════════════════════ */
.gg-footer-scope {
    --ft-bg:           #0D2117;
    --ft-primary:      #FFFFFF;
    --ft-accent:       #C8A84B;
    --ft-accent-light: #E0C76A;
    --ft-text:         #FFFFFF;
    --ft-text-muted:   rgba(255, 255, 255, 0.65);
    --ft-border:       rgba(255, 255, 255, 0.08);
    --ft-font-display: 'Cormorant Garamond', Georgia, serif;
    --ft-font-body:    'Outfit', sans-serif;
    --ft-ease:         cubic-bezier(0.4, 0, 0.2, 1);

    background: var(--ft-bg);
    color: var(--ft-text);
    font-family: var(--ft-font-body);
    position: relative;
    border-top: none;
    overflow: hidden;
}

/* Top Accent Line */
.gg-footer-scope::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: var(--ft-accent);
    z-index: 2;
}

.ft-inner {
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 48px;
}

/* ─── Main Footer Grid ─── */
.ft-main {
    padding: 100px 0 80px;
    display: grid;
    grid-template-columns: 1.5fr 1fr 1fr 1.2fr;
    gap: 60px;
}

.ft-col {
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.6s var(--ft-ease);
}

.gg-footer-scope.ft-visible .ft-col:nth-child(1) { transition-delay: 0.1s; opacity: 1; transform: translateY(0); }
.gg-footer-scope.ft-visible .ft-col:nth-child(2) { transition-delay: 0.2s; opacity: 1; transform: translateY(0); }
.gg-footer-scope.ft-visible .ft-col:nth-child(3) { transition-delay: 0.3s; opacity: 1; transform: translateY(0); }
.gg-footer-scope.ft-visible .ft-col:nth-child(4) { transition-delay: 0.4s; opacity: 1; transform: translateY(0); }

.ft-col-title {
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.15em;
    color: var(--ft-accent);
    margin-bottom: 32px;
}

/* ─── LOGO: DigiFlow-style structure ─── */
.ft-brand-logo {
    display: inline-flex;
    align-items: center;
    gap: 15px;
    text-decoration: none;
    margin-bottom: 25px;
}

.ft-logo-mark {
    width: 60px;
    height: 60px;
    background: linear-gradient(135deg, rgba(200, 168, 75, 0.3) 0%, rgba(224, 199, 106, 0.2) 100%);
    border: 2px solid rgba(200, 168, 75, 0.5);
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    transition: all 0.3s ease;
    flex-shrink: 0;
    box-shadow: 0 0 20px rgba(200, 168, 75, 0.3);
}

.ft-brand-logo:hover .ft-logo-mark {
    box-shadow: 0 8px 30px rgba(200, 168, 75, 0.5);
    border-color: rgba(224, 199, 106, 0.6);
}

.ft-brand-logo:hover .ft-logo-mark img {
    transform: scale(1.1);
}

.ft-logo-mark img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    display: block;
    transition: all 0.3s ease;
}

.ft-logo-name {
    font-family: var(--ft-font-display);
    font-size: 28px;
    font-weight: 700;
    line-height: 1;
    background: linear-gradient(135deg, #ffffff 0%, rgba(200, 168, 75, 0.95) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    filter: drop-shadow(0 0 20px rgba(200, 168, 75, 0.3));
}

.ft-brand-desc {
    font-size: 0.95rem;
    line-height: 1.7;
    color: var(--ft-text-muted);
    max-width: 300px;
}

/* ─── Nav Links ─── */
.ft-nav {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.ft-nav a {
    display: inline-flex;
    align-items: center;
    text-decoration: none;
    color: var(--ft-text-muted);
    font-weight: 500;
    font-size: 1rem;
    transition: all 0.25s var(--ft-ease);
    position: relative;
    padding: 4px 0;
}

.ft-nav a::after {
    content: '';
    position: absolute;
    bottom: 0; left: 0; width: 24px;
    height: 1.5px;
    background: var(--ft-accent);
    transform: scaleX(0);
    transform-origin: left;
    transition: transform 0.3s var(--ft-ease);
}

.ft-nav a:hover { color: #FFFFFF; transform: translateX(4px); }
.ft-nav a:hover::after { transform: scaleX(1); }

/* ─── Contact Info ─── */
.ft-contact-list {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.ft-contact-item {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.ft-contact-label {
    font-size: 0.65rem;
    font-weight: 600;
    text-transform: uppercase;
    color: var(--ft-accent);
    letter-spacing: 0.05em;
}

.ft-contact-value {
    font-size: 1rem;
    color: var(--ft-text-muted);
    text-decoration: none;
    transition: color 0.2s;
}

a.ft-contact-value:hover { color: #FFFFFF; }

/* ─── Bottom Bar ─── */
.ft-bottom {
    border-top: 1px solid var(--ft-border);
    padding: 40px 0;
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 24px;
    flex-wrap: wrap;
    opacity: 0;
    transition: opacity 0.8s var(--ft-ease) 0.5s;
}

.gg-footer-scope.ft-visible .ft-bottom { opacity: 1; }

.ft-copy {
    font-size: 0.85rem;
    color: var(--ft-text-muted);
}

.ft-copy span { font-weight: 600; color: #FFFFFF; }

.ft-socials {
    display: flex;
    gap: 16px;
}

.ft-social-link {
    color: var(--ft-text-muted);
    transition: all 0.3s var(--ft-ease);
    display: flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid var(--ft-border);
}

.ft-social-link:hover {
    color: var(--ft-bg);
    background: var(--ft-accent);
    border-color: var(--ft-accent);
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(200, 168, 75, 0.25);
}

.ft-social-link svg { width: 18px; height: 18px; fill: currentColor; }

/* Privacy / Legal links */
.ft-legal {
    display: flex;
    gap: 24px;
    margin-left: auto;
}

.ft-legal-link {
    font-size: 0.85rem;
    color: var(--ft-text-muted);
    text-decoration: none;
    transition: color 0.25s var(--ft-ease);
}

.ft-legal-link:hover { color: #FFFFFF; }

/* ─── Responsive ─── */
@media (max-width: 1024px) {
    .ft-main {
        grid-template-columns: 1fr 1fr;
        gap: 60px 48px;
        padding: 80px 0;
        text-align: center;
    }
    .ft-col {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .ft-brand-col {
        grid-column: 1 / -1;
        margin-bottom: 20px;
    }
    .ft-brand-desc {
        max-width: 100%;
    }
    .ft-nav a,
    .ft-contact-item {
        justify-content: center;
    }
    .ft-nav a:hover {
        transform: translateY(-2px);
    }
    .ft-nav a::after {
        left: 50%;
        transform: translateX(-50%) scaleX(0);
    }
    .ft-nav a:hover::after {
        transform: translateX(-50%) scaleX(1);
    }
    .ft-bottom {
        flex-direction: column;
        align-items: center;
        text-align: center;
        gap: 32px;
    }
    .ft-legal {
        margin: 0;
        justify-content: center;
    }
}

@media (max-width: 640px) {
    .ft-inner { padding: 0 24px; }
    .ft-main {
        grid-template-columns: 1fr;
        gap: 48px;
        padding: 60px 0;
    }
    .ft-logo-mark {
        width: 50px;
        height: 50px;
    }
    .ft-logo-name {
        font-size: 24px;
    }
    .ft-bottom {
        flex-direction: column;
        align-items: center;
        text-align: center;
        padding: 32px 0;
    }
    .ft-legal {
        margin: 16px 0 0;
        order: 3;
        justify-content: center;
        margin-left: 0;
    }
}
    </style>
  </head>

<body>
    <!-- Footer Section — GreenGrow Fertilizers -->
    <footer class="gg-footer-scope">
        <div class="ft-inner">
            <!-- MAIN GRID -->
            <div class="ft-main">
                <!-- Brand -->
                <div class="ft-col ft-brand-col">
                    <a href="#" class="ft-brand-logo">
                        <div class="ft-logo-mark">
                            <img src="images/logo.svg" alt="AgroFanema Logo">
                        </div>
                        <span class="ft-logo-name">AgroFanema</span>
                    </a>
                    <p class="ft-brand-desc">
                        Crafting premium organic fertilizers that nourish plants and restore the earth's natural microbiome.
                    </p>
                </div>

                <!-- Links 1 -->
                <div class="ft-col">
                    <div class="ft-col-title">Navigation</div>
                    <ul class="ft-nav">
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Products</a></li>
                        <li><a href="#">Our Process</a></li>
                        <li><a href="#">About Us</a></li>
                    </ul>
                </div>

                <!-- Links 2 -->
                <div class="ft-col">
                    <div class="ft-col-title">Support</div>
                    <ul class="ft-nav">
                        <li><a href="#">Help Center</a></li>
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">Wholesale</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="ft-col">
                    <div class="ft-col-title">Contact</div>
                    <ul class="ft-contact-list">
                        <li class="ft-contact-item">
                            <span class="ft-contact-label">Email</span>
                            <a href="mailto:hello@greengrow.com" class="ft-contact-value">hello@greengrow.com</a>
                        </li>
                        <li class="ft-contact-item">
                            <span class="ft-contact-label">Office</span>
                            <span class="ft-contact-value">Portland, Oregon, USA</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- BOTTOM BAR -->
            <div class="ft-bottom">
                <p class="ft-copy">© 2026 <span>GreenGrow Fertilizers</span>. All rights reserved.</p>

                <div class="ft-legal">
                    <a href="#" class="ft-legal-link">Terms of Conditions</a>
                </div>

                <div class="ft-socials">
                    <a href="#" class="ft-social-link" aria-label="Instagram">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                            <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                        </svg>
                    </a>
                    <a href="#" class="ft-social-link" aria-label="LinkedIn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path
                                d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z" />
                            <rect x="2" y="9" width="4" height="12" />
                            <circle cx="4" cy="4" r="2" />
                        </svg>
                    </a>
                    <a href="#" class="ft-social-link" aria-label="Facebook">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <script>
      // Footer scroll-reveal animation
(function () {
    const scope = document.querySelector('.gg-footer-scope');
    if (!scope) return;

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    scope.classList.add('ft-visible');
                    observer.disconnect();
                }
            });
        },
        { threshold: 0.15 }
    );

    observer.observe(scope);
})();
    </script>
</body>

</html>