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

    .product-price-block {
      display: flex;
      align-items: baseline;
      gap: 16px;
      margin-bottom: 32px;
    }

    .product-price {
      font-family: 'Outfit', sans-serif;
      font-size: 2rem;
      font-weight: 600;
      color: var(--accent);
    }

    .product-price-original {
      font-size: 1.2rem;
      color: var(--muted);
      text-decoration: line-through;
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

      .product-price {
        font-size: 1.6rem;
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

      .product-price-block {
        margin-bottom: 24px;
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
            <div class="features-grid">
              <div class="feature-item">
                <div class="feature-icon">
                  <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10"/><path d="m9 12 2 2 4-4"/></svg>
                </div>
                <div class="feature-content">
                  <h4>100% Organic</h4>
                  <p>Certified organic ingredients with no synthetic additives</p>
                </div>
              </div>
              <div class="feature-item">
                <div class="feature-icon">
                  <svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-5-5 4 4 0 0 1-5-5"/><path d="M8.5 8.5v.01"/><path d="M16 15.5v.01"/><path d="M12 12v.01"/></svg>
                </div>
                <div class="feature-content">
                  <h4>Nutrient Rich</h4>
                  <p>Packed with essential macro and micronutrients</p>
                </div>
              </div>
              <div class="feature-item">
                <div class="feature-icon">
                  <svg viewBox="0 0 24 24"><path d="M21.54 15H17a2 2 0 0 0-2 2v4.54"/><path d="M7 3.34V5a3 3 0 0 0 3 3a2 2 0 0 1 2 2c0 1.1.9 2 2 2a2 2 0 0 0 2-2c0-1.1.9-2 2-2h3.17"/><path d="M11 21.95V18a2 2 0 0 0-2-2a2 2 0 0 1-2-2v-1a2 2 0 0 0-2-2H2.05"/><circle cx="12" cy="12" r="10"/></svg>
                </div>
                <div class="feature-content">
                  <h4>Eco-Friendly</h4>
                  <p>Sustainably sourced and environmentally conscious</p>
                </div>
              </div>
              <div class="feature-item">
                <div class="feature-icon">
                  <svg viewBox="0 0 24 24"><path d="M12 3a6 6 0 0 0 9 9 9 9 0 1 1-9-9Z"/></svg>
                </div>
                <div class="feature-content">
                  <h4>Slow Release</h4>
                  <p>Provides nutrients over extended periods</p>
                </div>
              </div>
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
    const products = [
      { id: 1, name: "Premium Organic Compost", category: "organic", price: 34.99, image: "https://images.unsplash.com/photo-1416879595882-3373a0480b5b?w=800&h=1000&fit=crop", badge: "new", description: "Elevate your garden with our premium organic compost, carefully crafted from the finest natural ingredients. Rich in essential nutrients and beneficial microorganisms, it transforms ordinary soil into a thriving ecosystem for your plants." },
      { id: 2, name: "Rose Garden Fertilizer", category: "specialty", price: 29.99, image: "https://images.unsplash.com/photo-1585320806297-9794b3e4eeae?w=800&h=1000&fit=crop", badge: "", description: "Specially formulated for roses and flowering plants, this premium fertilizer promotes abundant blooms with vibrant colors. The balanced nutrient profile ensures healthy root development and long-lasting flower displays." },
      { id: 3, name: "Liquid Seaweed Extract", category: "liquid", price: 24.99, image: "https://images.unsplash.com/photo-1466692476868-aef1dfb1e735?w=800&h=1000&fit=crop", badge: "", description: "Harness the power of the ocean with our concentrated seaweed extract. This natural growth enhancer strengthens plant immunity, improves stress tolerance, and promotes lush, healthy foliage." },
      { id: 4, name: "All-Purpose Plant Food", category: "granular", price: 19.99, originalPrice: 24.99, image: "https://images.unsplash.com/photo-1591857177580-dc82b9ac4e1e?w=800&h=1000&fit=crop", badge: "sale", description: "A versatile granular fertilizer perfect for all plants in your garden. The slow-release formula provides consistent nutrition throughout the growing season, making gardening effortless." },
      { id: 5, name: "Bone Meal Organic", category: "organic", price: 22.99, image: "https://images.unsplash.com/photo-1523348837708-15d4a09cfac2?w=800&h=1000&fit=crop", badge: "", description: "Premium organic bone meal enriched with phosphorus for strong root development and prolific flowering. Perfect for bulbs, roses, and vegetable gardens seeking natural nutrition." },
      { id: 6, name: "Orchid Bloom Booster", category: "specialty", price: 39.99, image: "https://images.unsplash.com/photo-1459411552884-841db9b3cc2a?w=800&h=1000&fit=crop", badge: "new", description: "Designed exclusively for orchids, this specialized formula encourages spectacular blooms and healthy growth. The precise nutrient balance mimics orchids' natural tropical environment." },
      { id: 7, name: "Fish Emulsion Liquid", category: "liquid", price: 27.99, image: "https://images.unsplash.com/photo-1518531933037-91b2f5f229cc?w=800&h=1000&fit=crop", badge: "", description: "Traditional organic fish emulsion packed with nitrogen for rapid green growth. Perfect for vegetables and leafy plants that need a quick nutritional boost." },
      { id: 8, name: "Vegetable Garden Mix", category: "organic", price: 32.99, image: "https://images.unsplash.com/photo-1464226184884-fa280b87c399?w=800&h=1000&fit=crop", badge: "", description: "Complete organic nutrition for your vegetable garden. This premium blend promotes abundant harvests with vegetables that are more nutritious and flavorful." },
      { id: 9, name: "Slow Release Granules", category: "granular", price: 44.99, image: "https://images.unsplash.com/photo-1516253593875-bd7ba052b5f4?w=800&h=1000&fit=crop", badge: "", description: "Professional-grade slow-release fertilizer that feeds your plants for up to 6 months. Perfect for busy gardeners who want beautiful results with minimal effort." },
      { id: 10, name: "Citrus Tree Formula", category: "specialty", price: 36.99, image: "https://images.unsplash.com/photo-1587049352846-4a222e784d38?w=800&h=1000&fit=crop", badge: "", description: "Tailored nutrition for citrus trees including lemons, oranges, and limes. The specialized formula prevents yellowing leaves and promotes abundant, juicy fruit production." },
      { id: 11, name: "Concentrated Grow Liquid", category: "liquid", price: 49.99, image: "https://images.unsplash.com/photo-1530836369250-ef72a3f5cda8?w=800&h=1000&fit=crop", badge: "new", description: "Ultra-concentrated liquid fertilizer for maximum growth and productivity. Just a small amount delivers powerful nutrition that transforms your plants' performance." },
      { id: 12, name: "Worm Castings Pure", category: "organic", price: 28.99, image: "https://images.unsplash.com/photo-1592419044706-39796d40f98c?w=800&h=1000&fit=crop", badge: "", description: "Pure, premium worm castings teeming with beneficial microbes. This living fertilizer improves soil structure, water retention, and provides gentle, balanced nutrition." }
    ];

    const categoryIcons = {
      organic: '<svg viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 0 10 10 4 4 0 0 1-5-5 4 4 0 0 1-5-5"/><path d="M8.5 8.5v.01"/><path d="M16 15.5v.01"/><path d="M12 12v.01"/></svg>',
      specialty: '<svg viewBox="0 0 24 24"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>',
      liquid: '<svg viewBox="0 0 24 24"><path d="M12 2.69l5.66 5.66a8 8 0 1 1-11.31 0z"/></svg>',
      granular: '<svg viewBox="0 0 24 24"><circle cx="7.5" cy="7.5" r="1.5"/><circle cx="16.5" cy="7.5" r="1.5"/><circle cx="7.5" cy="16.5" r="1.5"/><circle cx="16.5" cy="16.5" r="1.5"/><circle cx="12" cy="12" r="1.5"/></svg>'
    };

    document.addEventListener('DOMContentLoaded', () => {
      // Get product ID from URL
      const urlParams = new URLSearchParams(window.location.search);
      const productId = parseInt(urlParams.get('id')) || 1;

      // Find the product
      const product = products.find(p => p.id === productId) || products[0];

      // Update page content
      document.title = `${product.name} | GreenGrow Fertilizers`;
      
      document.getElementById('product-title').textContent = product.name;
      document.getElementById('main-image').src = product.image;
      document.getElementById('main-image').alt = product.name;
      document.getElementById('product-description').textContent = product.description;
      document.getElementById('category-text').textContent = product.category.charAt(0).toUpperCase() + product.category.slice(1);

      // Update category icon
      const categoryTag = document.getElementById('product-category');
      categoryTag.innerHTML = categoryIcons[product.category] + `<span id="category-text">${product.category.charAt(0).toUpperCase() + product.category.slice(1)}</span>`;

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
