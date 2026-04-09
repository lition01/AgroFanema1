<?php 
require_once __DIR__ . '/../../essentials/db_connect.php';
$settings_stmt = $pdo->query("SELECT * FROM settings WHERE id = 1");
$site_settings = $settings_stmt->fetch(PDO::FETCH_ASSOC);

$s_phone1 = $site_settings['phone_1'] ?? '+355 693334644';
$s_phone2 = $site_settings['phone_2'] ?? '+355 682071125';
$s_email = $site_settings['email'] ?? 'agrofanema@gmail.com';
$s_addr = $site_settings['address'] ?? 'Kozare, Kuçovë';
?>

<section class="ct-simple-scope" id="contact" aria-label="Contact AgroFanema">
  <style>
    .ct-simple-scope {
      --primary: #1A3329;
      --accent:  #C8A84B;
      --bg:      #F5F2EA;
      --border:  #E2E0DA;
      --text:    #1A1A1A;
      --muted:   #6B6B62;
      --ease:    cubic-bezier(0.16, 1, 0.3, 1);
      
      position: relative;
      background: linear-gradient(135deg, #FDFCF9 0%, #F5F2EA 100%);
      color: var(--text);
      padding: 80px 24px;
      font-family: 'Outfit', sans-serif;
      z-index: 1;
    }

    .ct-simple-scope .inner {
      max-width: 1100px;
      margin: 0 auto;
      position: relative;
    }

    /* ── Header ── */
    .ct-simple-scope .header {
      text-align: center;
      margin-bottom: 60px;
    }

    .ct-simple-scope .eyebrow {
      display: block;
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.3em;
      color: var(--accent);
      margin-bottom: 16px;
    }

    .ct-simple-scope h1 {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(2.5rem, 5vw, 4rem);
      font-weight: 500;
      color: var(--primary); /* Use primary green instead of white */
      margin-bottom: 20px;
      line-height: 1.1;
    }

    .ct-simple-scope h1 span {
      font-style: italic;
      color: var(--accent);
      text-shadow: 0 0 30px rgba(200, 168, 75, 0.2);
    }

    .ct-simple-scope .desc {
      font-size: 1.1rem;
      color: var(--muted); /* Use muted text color */
      max-width: 500px;
      margin: 0 auto;
      font-weight: 300;
      line-height: 1.6;
    }

    /* ── Grid ── */
    .ct-simple-scope .grid {
      display: grid;
      grid-template-columns: 1fr 1.5fr;
      gap: 0;
      align-items: stretch;
      box-shadow: 0 30px 90px rgba(13, 33, 23, 0.15); /* Softer Shadow */
      border-radius: 12px;
      overflow: hidden;
    }

    /* ── Info ── */
    .ct-simple-scope .info-panel {
      background: var(--primary); /* Solid dark green */
      color: #FFFFFF;
      padding: 50px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .ct-simple-scope .info-list {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .ct-simple-scope .info-item {
      padding-bottom: 32px;
      margin-bottom: 32px;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .ct-simple-scope .info-item:last-child {
      padding-bottom: 0;
      margin-bottom: 0;
      border-bottom: none;
    }

    .ct-simple-scope .label {
      display: block;
      font-size: 0.65rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.15em;
      color: var(--accent);
      margin-bottom: 8px;
    }

    .ct-simple-scope .value {
      font-size: 1.1rem;
      color: #FFFFFF;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s;
    }

    .ct-simple-scope .value:hover {
      color: var(--accent);
    }

    .ct-simple-scope .sub-value {
      display: block;
      font-size: 0.8rem;
      color: rgba(255, 255, 255, 0.5);
      margin-top: 4px;
      font-weight: 300;
    }

    /* ── Form ── */
    .ct-simple-scope .form-box {
      background: #FFFFFF; /* Pure white */
      padding: 50px;
      display: flex;
      flex-direction: column;
      justify-content: center;
      transition: height 0.5s var(--ease);
      border-right: 4px solid var(--accent); /* Premium Gold Detail */
    }

    .ct-simple-scope .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 30px;
    }

    .ct-simple-scope .field {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .ct-simple-scope .field.full {
      grid-column: span 2;
    }

    .ct-simple-scope input, 
    .ct-simple-scope select, 
    .ct-simple-scope textarea {
      font-family: inherit;
      font-size: 0.95rem;
      padding: 12px 0;
      border: none;
      border-bottom: 1px solid var(--border);
      background: transparent;
      color: var(--primary);
      outline: none;
      transition: border-color 0.3s;
    }

    .ct-simple-scope input:focus,
    .ct-simple-scope textarea:focus {
      outline: none;
      border-color: var(--accent);
      background: #FFFFFF;
      box-shadow: 0 0 0 4px rgba(200, 168, 75, 0.08);
    }

    .ct-simple-scope textarea {
      min-height: 100px;
      resize: none;
    }

    .ct-simple-scope .submit-btn {
      grid-column: 1 / -1;
      background: var(--accent);
      color: var(--primary);
      border: none;
      padding: 16px 32px;
      font-size: 0.95rem;
      font-weight: 700;
      border-radius: 100px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      transition: all 0.4s var(--ease);
      box-shadow: 0 10px 30px rgba(200, 168, 75, 0.25);
    }

    .ct-simple-scope .submit-btn:hover {
      background: var(--primary);
      color: #FFFFFF;
      transform: translateY(-3px);
      box-shadow: 0 15px 40px rgba(13, 33, 23, 0.3);
    }

    .ct-simple-scope .submit-btn.is-loading {
      background: var(--muted);
      cursor: wait;
      pointer-events: none;
    }

    .ct-simple-scope .submit-btn.is-loading svg {
      animation: ct-spin 1s linear infinite;
    }

    @keyframes ct-spin {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }

    /* ── Success State ── */
    .ct-simple-scope .success-msg {
      display: none;
      text-align: center;
      padding: 40px 0;
      opacity: 0;
      transform: translateY(20px);
    }

    .ct-simple-scope .success-msg.active {
      display: block;
      animation: ct-fade-in-up 0.8s var(--ease) forwards;
    }

    .ct-simple-scope .contact-form.fade-out {
      animation: ct-fade-out 0.5s var(--ease) forwards;
      pointer-events: none;
    }

    @keyframes ct-fade-in-up {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes ct-fade-out {
      to {
        opacity: 0;
        transform: scale(0.95);
      }
    }

    .ct-simple-scope .success-icon {
      width: 64px;
      height: 64px;
      background: var(--accent);
      color: #FFFFFF;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 24px;
      box-shadow: 0 10px 30px rgba(200, 168, 75, 0.3);
    }

    .ct-simple-scope .success-msg h3 {
      font-family: 'Cormorant Garamond', serif;
      font-size: 2.2rem;
      color: var(--primary);
      margin-bottom: 12px;
      font-weight: 600;
    }

    .ct-simple-scope .success-msg p {
      color: var(--muted);
      font-weight: 300;
      font-size: 1.1rem;
    }

    /* ── Responsive ── */
    @media (max-width: 900px) {
      .ct-simple-scope .grid {
        grid-template-columns: 1fr;
      }
      .ct-simple-scope .info-panel {
        border-radius: 4px 4px 0 0;
        padding: 40px 30px;
      }
      .ct-simple-scope .form-box {
        border-radius: 0 0 4px 4px;
        padding: 40px 30px;
      }
      .ct-simple-scope .header {
        margin-bottom: 40px;
      }
    }

    @media (max-width: 600px) {
      .ct-simple-scope {
        padding: 40px 20px;
      }
      .ct-simple-scope .info-panel,
      .ct-simple-scope .form-box {
        padding: 32px 20px;
      }
      .ct-simple-scope .form-grid {
        grid-template-columns: 1fr;
        gap: 20px;
      }
      .ct-simple-scope .field.full,
      .ct-simple-scope .submit-btn {
        grid-column: span 1;
      }
    }

    /* ── Map ── */
    .ct-simple-scope .map-container {
      margin-top: 60px;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 20px 50px rgba(13, 33, 23, 0.1);
      border: 1px solid var(--border);
      height: 450px;
      opacity: 0;
      transform: translateY(30px);
      transition: all 0.8s var(--ease);
    }

    .ct-simple-scope .map-container.vis {
      opacity: 1;
      transform: translateY(0);
    }

    .ct-simple-scope .map-container iframe {
      width: 100%;
      height: 100%;
      border: 0;
      filter: grayscale(0.2) contrast(1.1);
    }

    /* ── Reveal Animations ── */
    .ct-rv {
      opacity: 0;
      transform: translateY(30px);
      transition: all 0.8s var(--ease);
    }
    .ct-rv.vis {
      opacity: 1;
      transform: translateY(0);
    }
    .ct-rv-d1 { transition-delay: 0.1s; }
    .ct-rv-d2 { transition-delay: 0.2s; }
  </style>

  <div class="inner">
    <header class="header ct-rv">
      <h1 class="ct-rv-d1"><?php echo t('contact'); ?> <span><?php echo t('us'); ?></span></h1>
      <p class="desc ct-rv-d2"><?php echo t('contact_desc'); ?></p>
    </header>

    <div class="grid ct-rv ct-rv-d2">
      <!-- Info -->
      <div class="info-panel">
        <ul class="info-list">
          <li class="info-item ct-rv ct-rv-d1">
            <span class="label"><?php echo t('headquarters'); ?></span>
            <div class="value"><?php echo $s_addr; ?></div>
            <span class="sub-value"><?php echo t('hq_sub'); ?></span>
          </li>
          <li class="info-item ct-rv ct-rv-d2">
            <span class="label"><?php echo t('phone_support'); ?></span>
            <a href="tel:<?php echo $s_phone1; ?>" class="value"><?php echo $s_phone1; ?></a>
            <?php if ($s_phone2): ?>
            <a href="tel:<?php echo $s_phone2; ?>" class="value" style="display: block; margin-top: 4px;"><?php echo $s_phone2; ?></a>
            <?php endif; ?>
          </li>
          <li class="info-item ct-rv ct-rv-d2" style="transition-delay: 0.3s">
            <span class="label"><?php echo t('email_enquiries'); ?></span>
            <a href="mailto:<?php echo $s_email; ?>" class="value"><?php echo $s_email; ?></a>
            <span class="sub-value"><?php echo t('avg_response'); ?></span>
          </li>
        </ul>
      </div>

      <!-- Form -->
      <div class="form-box">
        <form class="contact-form" id="simpleContactForm">
          <div class="form-grid">
            <div class="field">
              <label class="label"><?php echo t('first_name'); ?></label>
              <input type="text" name="first_name" placeholder="<?php echo t('first_name'); ?>" required>
            </div>
            <div class="field">
              <label class="label"><?php echo t('last_name'); ?></label>
              <input type="text" name="last_name" placeholder="<?php echo t('last_name'); ?>" required>
            </div>
            <div class="field">
              <label class="label"><?php echo t('email_address'); ?></label>
              <input type="email" name="email" placeholder="email@address.com" required>
            </div>
            <div class="field">
              <label class="label"><?php echo t('phone_number'); ?></label>
              <input type="tel" name="phone" placeholder="+355 123 456 789" required>
            </div>
            <div class="field full">
              <label class="label"><?php echo t('how_help'); ?></label>
              <textarea name="message" placeholder="<?php echo t('your_message'); ?>" required></textarea>
            </div>
            <button type="submit" class="submit-btn">
              <?php echo t('send_message'); ?>
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
            </button>
          </div>
        </form>

        <div class="success-msg" id="simpleSuccess">
          <div class="success-icon">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
          </div>
          <h3><?php echo t('message_sent'); ?></h3>
          <p><?php echo t('thank_you_reach'); ?><br><?php echo t('specialist_contact'); ?></p>
        </div>
      </div>
    </div>

    <!-- Map Section -->
    <div class="map-container ct-rv ct-rv-d2">
      <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3032.544838634567!2d19.900106776606066!3d40.8338179713753!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x13500b0056fc3f45%3A0x5a6117354cf14b56!2sAgro%20Fanema!5e0!3m2!1sen!2s!4v1711680000000!5m2!1sen!2s" 
        allowfullscreen="" 
        loading="lazy" 
        referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </div>

  <script>
    // Intersection Observer for reveal animations
    const observerOptions = {
      threshold: 0.15
    };
    
    const revealObserver = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('vis');
          revealObserver.unobserve(entry.target);
        }
      });
    }, observerOptions);

    document.querySelectorAll('.ct-rv').forEach(el => revealObserver.observe(el));

    document.getElementById('simpleContactForm').addEventListener('submit', function(e) {
      e.preventDefault();
      const form = this;
      const btn = form.querySelector('.submit-btn');
      const btnText = btn.innerHTML;
      const success = document.getElementById('simpleSuccess');
      const formBox = form.closest('.form-box');
      
      // Fix height to prevent jumping
      const currentHeight = formBox.offsetHeight;
      formBox.style.height = currentHeight + 'px';
      
      // Add loading state
      btn.classList.add('is-loading');
      btn.innerHTML = '<?php echo t('sending'); ?> <svg class="spinner" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round"><path d="M21 12a9 9 0 1 1-6.219-8.56" /></svg>';
      
      // --- Database Integration ---
      const formData = new FormData(form);

      fetch('essentials/contact-api.php?action=submit', {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(d => {
        if (d.status === 'success') {
           // Transition to success state
           form.classList.add('fade-out');
           setTimeout(() => {
             form.style.display = 'none';
             success.classList.add('active');
           }, 500);
        } else {
           alert('Error: ' + (d.message || 'Submission failed'));
           btn.classList.remove('is-loading');
           btn.innerHTML = btnText;
        }
      })
      .catch(err => {
        console.error('Submission error:', err);
        alert('Server Connection Error');
        btn.classList.remove('is-loading');
        btn.innerHTML = btnText;
      });
    });
  </script>
</section>
