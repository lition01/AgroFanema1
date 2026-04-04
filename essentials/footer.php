<?php
require_once __DIR__ . '/db_connect.php';
$settings_stmt = $pdo->query("SELECT * FROM settings WHERE id = 1");
$site_settings = $settings_stmt->fetch(PDO::FETCH_ASSOC);

// Fallbacks if DB is empty
$s_phone1 = $site_settings['phone_1'] ?? '+355 693334644';
$s_phone2 = $site_settings['phone_2'] ?? '+355 682071125';
$s_email = $site_settings['email'] ?? 'agrofanema@gmail.com';
$s_addr = $site_settings['address'] ?? 'Kozare, Kuçovë';
?>
<style>
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

/* ─── LOGO ─── */
.ft-brand-logo {
    display: flex;
    align-items: center;
    gap: 0;
    text-decoration: none;
    margin-bottom: 25px;
    flex-shrink: 0;
}

.ft-logo-mark {
    width: 86px; /* Increased from 78px */
    height: 86px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    border-radius: 0;
    background: none;
    transition: transform 0.35s var(--ft-ease);
    margin-left: -8px; /* Pull the logo slightly more left */
}

.ft-brand-logo:hover .ft-logo-mark {
    transform: scale(1.04);
}

.ft-logo-mark img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    position: relative;
    z-index: 1;
}

.ft-logo-text {
    display: flex;
    flex-direction: column;
    line-height: 1.15;
    margin-left: -12px; /* Pull the text closer to the logo image */
}

.ft-logo-name {
    font-family: var(--ft-font-display);
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--ft-primary);
    letter-spacing: 0.02em;
    transition: color 0.3s var(--ft-ease);
}

.ft-brand-logo:hover .ft-logo-name {
    color: var(--ft-accent);
}

.ft-brand-desc {
    font-size: 0.82rem;
    line-height: 1.6;
    color: var(--ft-text-muted);
    margin-bottom: 24px;
    max-width: 280px;
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
    position: relative;
    color: rgba(255, 255, 255, 0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.08);
    transition: color 0.35s var(--ft-ease),
                background 0.35s var(--ft-ease),
                border-color 0.35s var(--ft-ease),
                transform 0.35s var(--ft-ease),
                box-shadow 0.35s var(--ft-ease);
    overflow: hidden;
}

/* Shimmer layer on hover */
.ft-social-link::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(200, 168, 75, 0.18) 0%, rgba(200, 168, 75, 0.04) 100%);
    opacity: 0;
    transition: opacity 0.35s var(--ft-ease);
    border-radius: inherit;
}

.ft-social-link:hover::before {
    opacity: 1;
}

.ft-social-link:hover {
    color: var(--ft-accent);
    border-color: rgba(200, 168, 75, 0.45);
    transform: translateY(-3px) scale(1.08);
    box-shadow:
        0 8px 24px rgba(200, 168, 75, 0.2),
        0 0 0 1px rgba(200, 168, 75, 0.12) inset;
}

.ft-social-link svg { width: 18px; height: 18px; fill: none; stroke: currentColor; stroke-width: 1.8; stroke-linecap: round; stroke-linejoin: round; transition: transform 0.35s var(--ft-ease); position: relative; z-index: 1; }

.ft-social-link:hover svg { transform: scale(1.1); }

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

<!-- Footer Section — GreenGrow Fertilizers -->
<footer class="gg-footer-scope">
    <div class="ft-inner">
        <!-- MAIN GRID -->
        <div class="ft-main">
            <!-- Brand -->
                <div class="ft-col ft-brand-col">
                    <a href="index.php" class="ft-brand-logo">
                        <div class="ft-logo-mark">
                            <img src="images/logo.svg" alt="AgroFanema Logo">
                        </div>
                        <div class="ft-logo-text">
                            <span class="ft-logo-name">AgroFanema</span>
                        </div>
                    </a>
                    <p class="ft-brand-desc">
                        <?php echo t('footer_desc'); ?>
                    </p>
                </div>

                <!-- Links 1 -->
                <div class="ft-col">
                    <div class="ft-col-title"><?php echo t('quick_links'); ?></div>
                    <ul class="ft-nav">
                        <li><a href="index.php"><?php echo t('home'); ?></a></li>
                        <li><a href="products.php"><?php echo t('products'); ?></a></li>
                        <li><a href="about.php"><?php echo t('about'); ?></a></li>
                        <li><a href="contact.php"><?php echo t('contact'); ?></a></li>
                    </ul>
                </div>

                <!-- Links 2 -->
                <div class="ft-col">
                    <div class="ft-col-title"><?php echo t('about_us'); ?></div>
                    <ul class="ft-nav">
                        <li><a href="contact.php"><?php echo t('help_center'); ?></a></li>
                        <li><a href="contact.php"><?php echo t('shipping'); ?></a></li>
                        <li><a href="contact.php"><?php echo t('wholesale'); ?></a></li>
                        <li><a href="contact.php"><?php echo t('expert_advice'); ?></a></li>
                    </ul>
                </div>

            <!-- Contact -->
            <div class="ft-col">
                <div class="ft-col-title"><?php echo t('contact'); ?></div>
                <ul class="ft-contact-list">
                    <li class="ft-contact-item">
                        <span class="ft-contact-label"><?php echo t('email'); ?></span>
                        <a href="mailto:<?php echo $s_email; ?>" class="ft-contact-value"><?php echo $s_email; ?></a>
                    </li>
                    <li class="ft-contact-item">
                        <span class="ft-contact-label"><?php echo t('phone'); ?></span>
                        <a href="tel:<?php echo $s_phone1; ?>" class="ft-contact-value"><?php echo $s_phone1; ?></a>
                        <?php if($s_phone2): ?>
                        <a href="tel:<?php echo $s_phone2; ?>" class="ft-contact-value"><?php echo $s_phone2; ?></a>
                        <?php endif; ?>
                    </li>
                    <li class="ft-contact-item">
                        <span class="ft-contact-label"><?php echo t('office'); ?></span>
                        <span class="ft-contact-value"><?php echo $s_addr; ?></span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- BOTTOM BAR -->
        <div class="ft-bottom">
            <p class="ft-copy">© <?php echo date('Y'); ?> <span>AgroFanema</span>. <?php echo t('est'); ?> 1994. <?php echo t('all_rights_reserved'); ?></p>

            <div class="ft-legal">
                <a href="terms-of-conditions.php" class="ft-legal-link"><?php echo t('terms_conditions'); ?></a>
            </div>

            <div class="ft-socials">
                <a href="https://www.instagram.com/agrofanema?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="ft-social-link" aria-label="Instagram" target="_blank">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round">
                        <rect x="2" y="2" width="20" height="20" rx="5" ry="5" />
                        <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z" />
                        <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                    </svg>
                </a>
                <a href="https://www.facebook.com/people/Agro-Fanema/100063887894308/?locale=sq_AL#" class="ft-social-link" aria-label="Facebook" target="_blank">
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
