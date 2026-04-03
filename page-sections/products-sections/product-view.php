<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Product | GreenGrow Fertilizers</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    *, *::before, *::after {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    :root {
      --bg: #F5F2EA;
      --surface: #FFFFFF;
      --accent: #C8A84B;
      --primary: #1A3329;
      --text: #1A1A1A;
      --muted: #6B6B62;
      --border: #E2E0DA;
      --shadow-md: rgba(26, 51, 41, 0.13);
      --shadow-lg: rgba(26, 51, 41, 0.18);
      --ease: cubic-bezier(0.4, 0, 0.2, 1);
      --ease-out: cubic-bezier(0.16, 1, 0.3, 1);
    }

    body {
      font-family: 'Outfit', sans-serif;
      background: var(--bg);
      color: var(--text);
      line-height: 1.6;
      -webkit-font-smoothing: antialiased;
    }

    /* Panna-Inspired Product View Layout */
    .product-view {
      min-height: 100vh;
      padding: 40px clamp(20px, 5vw, 80px);
      opacity: 0;
      transform: translateY(20px);
      animation: product-view-reveal 0.8s var(--ease) forwards;
    }

    @keyframes product-view-reveal {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .product-container {
      max-width: 1400px;
      margin: 0 auto;
    }

    /* Back Navigation */
    .back-nav {
      margin-bottom: 40px;
    }

    .back-link {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
      color: var(--muted);
      font-size: 0.9rem;
      font-weight: 500;
      transition: color 0.3s var(--ease);
      padding: 12px 0;
    }

    .back-link:hover {
      color: var(--primary);
    }

    .back-link svg {
      width: 18px;
      height: 18px;
      stroke: currentColor;
      stroke-width: 1.5;
      fill: none;
      transition: transform 0.3s var(--ease);
    }

    .back-link:hover svg {
      transform: translateX(-4px);
    }

    /* Main Product Grid - Panna Style Split Layout */
    .product-main {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 80px;
      align-items: start;
    }

    /* Product Gallery */
    .product-gallery {
      position: sticky;
      top: 40px;
    }

    .gallery-main {
      width: 100%;
      aspect-ratio: 4/5;
      border-radius: 24px;
      overflow: hidden;
      background: var(--bg); /* Panna background */
      box-shadow: 
        0 30px 60px -20px rgba(26, 51, 41, 0.15),
        0 15px 30px -10px rgba(26, 51, 41, 0.05); /* Premium multi-layered shadow */
      position: relative;
      border: 1px solid rgba(26, 51, 41, 0.03);
    }

    .gallery-main img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.8s var(--ease);
    }

    .gallery-main:hover img {
      transform: scale(1.03);
    }

    .gallery-badge {
      position: absolute;
      top: 24px;
      left: 24px;
      padding: 8px 16px;
      font-size: 0.7rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      border-radius: 6px;
      background: var(--primary);
      color: #FFFFFF;
    }

    .gallery-badge.new {
      background: var(--accent);
      color: var(--primary);
    }

    .gallery-badge.sale {
      background: #B85C38;
    }

    /* Thumbnail Gallery */
    .gallery-thumbs {
      display: flex;
      gap: 16px;
      margin-top: 20px;
    }

    .thumb-item {
      width: 80px;
      height: 80px;
      border-radius: 12px;
      overflow: hidden;
      cursor: pointer;
      border: 2px solid transparent;
      transition: all 0.3s var(--ease);
      background: var(--surface);
    }

    .thumb-item:hover,
    .thumb-item.active {
      border-color: var(--accent);
    }

    .thumb-item img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    /* Product Details - Panna Inspired */
    .product-details {
      padding: 20px 0;
    }

    .product-category-tag {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      padding: 8px 16px;
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 100px;
      font-size: 0.75rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      color: var(--muted);
      margin-bottom: 24px;
    }

    .product-category-tag svg {
      width: 14px;
      height: 14px;
      stroke: var(--accent);
      stroke-width: 1.5;
      fill: none;
    }

    .product-title {
      font-family: 'Cormorant Garamond', serif;
      font-size: clamp(2.5rem, 4vw, 3.5rem);
      font-weight: 600;
      color: var(--primary);
      line-height: 1.15;
      margin-bottom: 20px;
      letter-spacing: -0.02em;
    }



    .product-description {
      font-size: 1.05rem;
      color: var(--muted);
      line-height: 1.8;
      margin-bottom: 40px;
      max-width: 500px;
    }

    /* Quantity Selector */
    .quantity-section {
      margin-bottom: 32px;
    }

    .quantity-label {
      display: block;
      font-size: 0.8rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      color: var(--muted);
      margin-bottom: 12px;
    }

    .quantity-selector {
      display: inline-flex;
      align-items: center;
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 12px;
      overflow: hidden;
    }

    .qty-btn {
      width: 50px;
      height: 50px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: transparent;
      border: none;
      cursor: pointer;
      color: var(--text);
      transition: all 0.2s var(--ease);
    }

    .qty-btn:hover {
      background: var(--bg);
    }

    .qty-btn svg {
      width: 18px;
      height: 18px;
      stroke: currentColor;
      stroke-width: 1.5;
      fill: none;
    }

    .qty-input {
      width: 60px;
      height: 50px;
      border: none;
      text-align: center;
      font-family: 'Outfit', sans-serif;
      font-size: 1rem;
      font-weight: 500;
      color: var(--text);
      background: transparent;
    }

    .qty-input:focus {
      outline: none;
    }

    /* Action Buttons */
    .action-buttons {
      display: flex;
      gap: 16px;
      margin-bottom: 48px;
    }

    .btn-add-cart {
      flex: 1;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 12px;
      padding: 18px 40px;
      background: var(--primary);
      color: #FFFFFF;
      border: none;
      border-radius: 100px;
      font-family: 'Outfit', sans-serif;
      font-size: 0.95rem;
      font-weight: 600;
      letter-spacing: 0.02em;
      cursor: pointer;
      transition: all 0.4s var(--ease);
      text-decoration: none;
    }

    .btn-add-cart:hover {
      background: #0D1A14;
      box-shadow: 0 12px 32px rgba(26, 51, 41, 0.2);
    }

    .btn-add-cart svg {
      width: 20px;
      height: 20px;
      stroke: currentColor;
      stroke-width: 1.5;
      fill: none;
    }

    .btn-wishlist {
      width: 60px;
      height: 60px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: var(--surface);
      border: 1px solid var(--border);
      border-radius: 100px;
      cursor: pointer;
      transition: all 0.3s var(--ease);
    }

    .btn-wishlist:hover {
      border-color: var(--accent);
      background: #FAFAF8;
    }

    .btn-wishlist svg {
      width: 22px;
      height: 22px;
      stroke: var(--muted);
      stroke-width: 1.5;
      fill: none;
      transition: all 0.3s var(--ease);
    }

    .btn-wishlist:hover svg {
      stroke: var(--accent);
    }

    /* Features List */
    .product-features {
      border-top: 1px solid var(--border);
      padding-top: 40px;
    }

    .features-title {
      font-family: 'Cormorant Garamond', serif;
      font-size: 1.4rem;
      font-weight: 600;
      color: var(--primary);
      margin-bottom: 24px;
    }

    .features-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 20px;
    }

    .feature-item {
      display: flex;
      align-items: flex-start;
      gap: 14px;
      padding: 16px;
      background: var(--surface);
      border-radius: 14px;
      border: 1px solid var(--border);
    }

    .feature-icon {
      width: 40px;
      height: 40px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: var(--bg);
      border-radius: 10px;
      flex-shrink: 0;
    }

    .feature-icon svg {
      width: 20px;
      height: 20px;
      stroke: var(--accent);
      stroke-width: 1.5;
      fill: none;
    }

    .feature-content h4 {
      font-size: 0.9rem;
      font-weight: 600;
      color: var(--primary);
      margin-bottom: 4px;
    }

    .feature-content p {
      font-size: 0.8rem;
      color: var(--muted);
      line-height: 1.5;
    }

    /* Shipping Info Bar */
    .shipping-bar {
      display: flex;
      gap: 24px;
      margin-top: 32px;
      padding: 20px;
      background: var(--surface);
      border-radius: 14px;
      border: 1px solid var(--border);
    }

    .shipping-item {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 0.85rem;
      color: var(--muted);
    }

    .shipping-item svg {
      width: 18px;
      height: 18px;
      stroke: var(--accent);
      stroke-width: 1.5;
      fill: none;
    }

    /* Responsive */
    @media (max-width: 1024px) {
      .product-main {
        grid-template-columns: 1fr;
        gap: 48px;
      }

      .product-gallery {
        position: relative;
        top: 0;
      }

      .gallery-main {
        aspect-ratio: 1;
      }
    }

    @media (max-width: 768px) {
      .product-view {
        padding: 24px 16px;
      }

      .product-title {
        font-size: 2rem;
      }



      .features-grid {
        grid-template-columns: 1fr;
      }

      .action-buttons {
        flex-direction: column;
      }

      .btn-wishlist {
        width: 100%;
      }

      .shipping-bar {
        flex-direction: column;
        gap: 16px;
      }

      .gallery-thumbs {
        gap: 10px;
      }

      .thumb-item {
        width: 60px;
        height: 60px;
      }
    }

    @media (max-width: 480px) {
      .back-nav {
        margin-bottom: 24px;
      }

      .product-category-tag {
        margin-bottom: 16px;
      }

      .product-title {
        font-size: 1.75rem;
        margin-bottom: 16px;
      }



      .product-description {
        font-size: 0.95rem;
        margin-bottom: 32px;
      }

      .quantity-section {
        margin-bottom: 24px;
      }

      .btn-add-cart {
        padding: 16px 32px;
      }
    }
  </style>
</head>
<body>
  <?php // Product View Section — AgroFanema ?>

  <section class="gg-product-view-scope" id="product-view" aria-label="AgroFanema Product Detail">
    <div class="product-container">
      <nav class="back-nav">
        <a href="products.html" class="back-link">
          <svg viewBox="0 0 24 24"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
          Back to Products
        </a>
      </nav>

      <div class="product-main">
        <!-- Product Gallery -->
        <div class="product-gallery">
          <div class="gallery-main">
            <span class="gallery-badge" id="product-badge"></span>
            <img id="main-image" src="" alt="">
          </div>
          <div class="gallery-thumbs" id="gallery-thumbs">
            <!-- Thumbnails rendered by JS -->
          </div>
        </div>

        <!-- Product Details -->
        <div class="product-details">
          <div class="product-category-tag" id="product-category">
            <svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-5-5 4 4 0 0 1-5-5"/></svg>
            <span id="category-text">Organic</span>
          </div>

          <h1 class="product-title" id="product-title">Premium Organic Compost</h1>

          <p class="product-description" id="product-description">
            Elevate your garden with our premium organic compost, carefully crafted from the finest natural ingredients. Rich in essential nutrients and beneficial microorganisms, it transforms ordinary soil into a thriving ecosystem for your plants.
          </p>

          <div class="quantity-section">
            <label class="quantity-label">Quantity</label>
            <div class="quantity-selector">
              <button class="qty-btn" id="qty-minus">
                <svg viewBox="0 0 24 24"><path d="M5 12h14"/></svg>
              </button>
              <input type="number" class="qty-input" id="qty-input" value="1" min="1" max="99">
              <button class="qty-btn" id="qty-plus">
                <svg viewBox="0 0 24 24"><path d="M12 5v14"/><path d="M5 12h14"/></svg>
              </button>
            </div>
          </div>

          <div class="action-buttons">
            <a href="contact.php" class="btn-add-cart" id="add-to-cart">
              <svg viewBox="0 0 24 24"><circle cx="8" cy="21" r="1"/><circle cx="19" cy="21" r="1"/><path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12"/></svg>
              Add to Cart
            </a>
            <button class="btn-wishlist" id="btn-wishlist">
              <svg viewBox="0 0 24 24"><path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/></svg>
            </button>
          </div>

          <div class="product-features">
            <h3 class="features-title">Why Choose This Product</h3>
            <div class="features-grid" id="product-features-grid">
              <!-- Features rendered by JS -->
            </div>
          </div>

          <div class="shipping-bar">
            <div class="shipping-item">
              <svg viewBox="0 0 24 24"><path d="M13 17V3"/><path d="M18 6h-5"/><path d="M13 20h-2"/><path d="M5 10V3"/><path d="M10 6H5"/><path d="M5 20v-7"/><path d="M21 10v10"/><path d="M21 10H11"/></svg>
              <span>Free shipping over $50</span>
            </div>
            <div class="shipping-item">
              <svg viewBox="0 0 24 24"><rect width="20" height="14" x="2" y="5" rx="2"/><path d="M2 10h20"/></svg>
              <span>Secure payment</span>
            </div>
            <div class="shipping-item">
              <svg viewBox="0 0 24 24"><path d="M3 12a9 9 0 0 1 9-9 9.75 9.75 0 0 1 6.74 2.74L21 8"/><path d="M21 3v5h-5"/><path d="M21 12a9 9 0 0 1-9 9 9.75 9.75 0 0 1-6.74-2.74L3 16"/><path d="M8 16H3v5"/></svg>
              <span>30-day returns</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script>
    const categoryIcons = {
      biostimulants: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4.5 16.5c-1.5 1.26-2 3.5-2 3.5s2.24-.5 3.5-2M19.5 7.5c1.5-1.26 2-3.5 2-3.5s-2.24.5-3.5 2M8 12a4 4 0 1 0 8 0 4 4 0 1 0-8 0M2 2l20 20"/></svg>',
      crystalline: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 3h12l4 6-10 12L2 9zM11 3v18M22 9H2M4.5 6h15M16.5 18L18 9M7.5 18L6 9"/></svg>',
      granular: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="7" cy="7" r="1"/><circle cx="17" cy="7" r="1"/><circle cx="7" cy="17" r="1"/><circle cx="17" cy="17" r="1"/><circle cx="12" cy="12" r="1"/></svg>',
      soil_improvers: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 10V3M12 10a4 4 0 1 0 0 8 4 4 0 1 0 0-8ZM3 21h18M7 21v-3M17 21v-3M12 21v-3"/></svg>'
    };

    const featureIcons = [
      '<svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/></svg>',
      '<svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-5-5 4 4 0 0 1-5-5"/><path d="M8.5 8.5v.01"/><path d="M16 15.5v.01"/><path d="M12 12v.01"/></svg>',
      '<svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>',
      '<svg viewBox="0 0 24 24"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>'
    ];

    document.addEventListener('DOMContentLoaded', async () => {
      // Get product ID from URL
      const urlParams = new URLSearchParams(window.location.search);
      const productId = urlParams.get('id');

      if (!productId) {
        window.location.href = 'products.php';
        return;
      }

      // Fetch all products from API
      let product = null;
      try {
        const res = await fetch('essentials/product-api.php?action=list');
        const data = await res.json();
        if (data.success) {
          product = data.products.find(p => p.id === productId);
        }
      } catch (e) { console.error(e); }

      if (!product) {
        document.body.innerHTML = '<div style="padding: 100px; text-align: center;"><h1>Product Not Found</h1><a href="products.php">Back to products</a></div>';
        return;
      }

      // Update page content
      document.title = `${product.name_en} | GreenGrow Fertilizers`;
      
      document.getElementById('product-title').textContent = product.name_en;
      document.getElementById('main-image').src = product.image || '';
      document.getElementById('main-image').alt = product.name_en;
      document.getElementById('product-description').textContent = product.desc_en || '';
      
      // Update category
      const categoryText = product.category.charAt(0).toUpperCase() + product.category.slice(1);
      const categoryTag = document.getElementById('product-category');
      categoryTag.innerHTML = (categoryIcons[product.category] || categoryIcons.granular) + `<span id="category-text">${categoryText}</span>`;

      // Render Features
      const featuresGrid = document.getElementById('product-features-grid');
      featuresGrid.innerHTML = '';
      const features = product.features_en || [];
      features.forEach((feature, i) => {
        const icon = featureIcons[i % featureIcons.length];
        featuresGrid.innerHTML += `
          <div class="feature-item">
            <div class="feature-icon">${icon}</div>
            <div class="feature-content">
              <h4>${feature}</h4>
              <p>Key quality of our premium product line.</p>
            </div>
          </div>
        `;
      });

      // Generate thumbnail gallery (using same image with different crops for demo)
      const thumbsContainer = document.getElementById('gallery-thumbs');
      const thumbAngles = ['', '&sat=-10', '&bri=5', '&con=10'];
      thumbAngles.forEach((angle, i) => {
        const thumb = document.createElement('div');
        thumb.className = `thumb-item ${i === 0 ? 'active' : ''}`;
        thumb.innerHTML = `<img src="${product.image}${angle}" alt="${product.name} view ${i + 1}">`;
        thumb.addEventListener('click', () => {
          document.querySelectorAll('.thumb-item').forEach(t => t.classList.remove('active'));
          thumb.classList.add('active');
          document.getElementById('main-image').src = product.image + angle;
        });
        thumbsContainer.appendChild(thumb);
      });

      // Quantity controls
      const qtyInput = document.getElementById('qty-input');
      const qtyMinus = document.getElementById('qty-minus');
      const qtyPlus = document.getElementById('qty-plus');

      qtyMinus.addEventListener('click', () => {
        const current = parseInt(qtyInput.value) || 1;
        if (current > 1) {
          qtyInput.value = current - 1;
        }
      });

      qtyPlus.addEventListener('click', () => {
        const current = parseInt(qtyInput.value) || 1;
        if (current < 99) {
          qtyInput.value = current + 1;
        }
      });

      qtyInput.addEventListener('change', () => {
        let value = parseInt(qtyInput.value) || 1;
        if (value < 1) value = 1;
        if (value > 99) value = 99;
        qtyInput.value = value;
      });

      // Wishlist toggle
      const wishlistBtn = document.getElementById('btn-wishlist');
      let isWishlisted = false;

      wishlistBtn.addEventListener('click', () => {
        isWishlisted = !isWishlisted;
        const svg = wishlistBtn.querySelector('svg');
        if (isWishlisted) {
          svg.style.fill = 'var(--accent)';
          svg.style.stroke = 'var(--accent)';
        } else {
          svg.style.fill = 'none';
          svg.style.stroke = 'var(--muted)';
        }
      });
    });
  </script>
</body>
</html>
