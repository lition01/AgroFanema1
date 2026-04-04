<?php
require_once "essentials/db_connect.php";
require_once "essentials/translations.php"; // Ensure t() is available

$product_id = isset($_GET['id']) ? $_GET['id'] : null;
$product = null;

if ($product_id) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
        $stmt->execute([$product_id]);
        $row = $stmt->fetch();

        if ($row) {
            $lang = isset($_COOKIE['lang']) ? $_COOKIE['lang'] : 'sq';
            $p_name = ($lang === 'sq') ? ($row['name_sq'] ?: $row['name_en']) : ($row['name_en'] ?: $row['name_sq']);
            $p_desc = ($lang === 'sq') ? ($row['desc_sq'] ?: $row['desc_en']) : ($row['desc_en'] ?: $row['desc_sq']);
            
            $product = [
                'id'           => $row['id'],
                'name'         => $p_name,
                'category'     => $row['category'],
                'image'        => $row['image'],
                'full_details' => $p_desc
            ];
        }
    } catch (Exception $e) {
        $product = null;
    }
}

if (!$product) {
    header("Location: products.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="sq">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detajet e Produktit | AgroFanema</title>
    <meta name="description" content="Zbuloni detajet e plehrave tona organike premium. AgroFanema - Cilësi e garantuar për bujqësinë tuaj.">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://agrofanema.com/product-view.php?id=<?php echo $product_id; ?>">
    <meta property="og:title" content="<?php echo $product['name']; ?> | AgroFanema">
    <meta property="og:description" content="Zbuloni më shumë rreth <?php echo $product['name']; ?>. Zgjidhje organike për bujqësinë tuaj.">
    <meta property="og:image" content="https://agrofanema.com/images/logo.svg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:title" content="<?php echo $product['name']; ?> | AgroFanema">
    <meta property="twitter:description" content="Zbuloni plehrat tona organike premium.">
    <meta property="twitter:image" content="https://agrofanema.com/images/logo.svg">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="images/favicon.svg">
    <link rel="apple-touch-icon" href="images/favicon.svg">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg: #F5F2EA; /* Panna Background */
            --surface: #FFFFFF;
            --accent: #C8A84B;
            --primary: #1A3329; /* Dark Green for titles */
            --text: #1A1A1A; /* Almost black for body text */
            --muted: #6B6B62;
            --border: #E2E0DA;
            --ease: cubic-bezier(0.4, 0, 0.2, 1);
        }

        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Outfit', sans-serif; 
            background-color: #F5F2EA !important; /* Force Panna Background */
            color: var(--text); 
            overflow-x: hidden; 
            -webkit-font-smoothing: antialiased; 
        }

        .gg-product-view {
            padding: 80px clamp(20px, 4vw, 40px) 60px; /* Reduced from 140px / 120px */
            max-width: 1400px;
            margin: 0 auto;
            opacity: 0;
            transform: translateY(20px);
            animation: product-fade-in 0.8s var(--ease) forwards;
        }

        @keyframes product-fade-in {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--muted);
            font-size: 0.8rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            margin-bottom: 50px;
            transition: all 0.4s var(--ease);
        }
        .back-link:hover { color: var(--accent); transform: translateX(-5px); }
        .back-link svg { width: 18px; height: 18px; stroke: currentColor; fill: none; stroke-width: 2.5; }

        .product-container {
            display: grid;
            grid-template-columns: 0.85fr 1.15fr;
            gap: clamp(40px, 8vw, 100px);
            align-items: start; /* Ensures the gallery can be sticky within its track */
            position: relative;
        }

        /* ── Image Gallery ── */
        .product-gallery {
            position: sticky;
            top: 120px; /* Perfectly aligned below the 78px navbar with some breathing room */
            align-self: start; /* Essential for sticky to work in a grid */
            max-width: 580px;
            z-index: 10;
        }
        .main-img-wrap {
            width: 100%;
            aspect-ratio: 4/5;
            background: var(--bg); /* Panna background */
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 
                0 20px 40px -10px rgba(26, 51, 41, 0.15),
                0 10px 20px -5px rgba(26, 51, 41, 0.05); /* Premium multi-layered shadow */
            border: 1px solid rgba(26, 51, 41, 0.03);
        }
        .main-img-wrap img { width: 100%; height: 100%; object-fit: cover; }

        /* ── Product Info ── */
        .product-details {
            display: flex;
            flex-direction: column;
            padding-top: 20px;
        }
        .product-category {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: var(--accent);
            margin-bottom: 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }
        .product-category::after {
            content: '';
            width: 40px;
            height: 1px;
            background: var(--accent);
            opacity: 0.5;
        }
        .product-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(3rem, 6vw, 4.5rem);
            font-weight: 600;
            color: var(--primary);
            line-height: 1.1;
            margin-bottom: 32px;
            letter-spacing: -0.01em;
        }
        .product-price {
            font-size: 2.2rem;
            font-weight: 600;
            color: #000000; /* Pure Black for Price */
            margin-bottom: 40px;
            display: flex;
            align-items: baseline;
            gap: 12px;
        }
        .product-price span { font-size: 1rem; color: var(--muted); font-weight: 400; font-family: 'Outfit', sans-serif; }

        .product-desc-long {
            font-size: 1.15rem;
            line-height: 1.8;
            color: var(--muted);
            margin-bottom: 48px;
            font-weight: 400;
        }


        /* ── Action Buttons ── */
        .action-group {
            display: flex;
            gap: 20px;
            margin-bottom: 60px;
        }
        .order-now-btn {
            flex: 1;
            background: var(--primary); /* Dark Green Button */
            color: #FFFFFF;
            border: none;
            padding: 22px 40px;
            border-radius: 12px; /* Moreno square-ish style */
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.15em;
            cursor: pointer;
            transition: all 0.5s var(--ease);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            box-shadow: 0 10px 30px rgba(26, 51, 41, 0.15);
        }
        .order-now-btn:hover {
            background: var(--accent);
            transform: translateY(-4px);
            box-shadow: 0 15px 40px rgba(200, 168, 75, 0.35);
        }
        .order-now-btn svg { width: 18px; height: 18px; fill: none; stroke: currentColor; stroke-width: 2.5; }

        /* ── Meta Info ── */
        .product-meta {
            border-top: 1px solid var(--border);
            padding-top: 40px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 40px;
        }
        .meta-item {
            margin-bottom: 0;
        }
        .meta-label { 
            font-size: 0.75rem; 
            font-weight: 700; 
            text-transform: uppercase; 
            letter-spacing: 0.15em; 
            color: var(--accent); 
            margin-bottom: 12px; 
            display: block; 
        }
        .meta-content { 
            font-size: 1rem; 
            line-height: 1.6; 
            color: var(--muted); 
            font-weight: 400;
        }

        @media (max-width: 1024px) {
            .product-container { grid-template-columns: 1fr; }
            .product-gallery { position: static; margin-bottom: 60px; }
            .main-img-wrap { aspect-ratio: 16/9; }
            .features-list { grid-template-columns: 1fr; }
            .product-meta { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <?php include "essentials/navbar.php" ?>

    <main class="gg-product-view">
        <a href="products.php" class="back-link">
            <svg viewBox="0 0 24 24"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
            <?php echo t('back_to_products'); ?>
        </a>

        <div class="product-container">
            <div class="product-gallery">
                <div class="main-img-wrap">
                    <img src="<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                </div>
            </div>

            <div class="product-details">
                <span class="product-category">
                    <?php echo t('cat_' . $product['category']); ?>
                </span>
                <h1 class="product-title"><?php echo $product['name']; ?></h1>
                
                <p class="product-desc-long">
                    <?php echo $product['full_details']; ?>
                </p>

                <div class="action-group">
                    <button class="order-now-btn" id="order-btn-view">
                        <?php echo t('contact_us'); ?>
                        <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </main>

    <?php include "essentials/footer.php" ?>

    <script>
        document.getElementById('order-btn-view').addEventListener('click', function() {
            const productName = "<?php echo $product['name']; ?>";
            alert(`Thank you for your interest in ${productName}!\n\nThis will now proceed to the secure checkout/contact portal in our dashboard.`);
            // You can redirect here: window.location.href = 'contact.php?product=<?php echo $product['id']; ?>';
        });
    </script>
</body>
</html>