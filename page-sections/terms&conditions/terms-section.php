<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms of Conditions | GreenGrow Fertilizers</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* Global Reset */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html {
            scroll-behavior: smooth;
        }
        
        body {
            font-family: 'Outfit', sans-serif;
            overflow-x: hidden;
            background: #F5F2EA;
            color: #1A1A1A;
        }

        .terms-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 160px 48px 100px; /* Offset for fixed navbar */
        }

        .terms-header {
            margin-bottom: 60px;
            text-align: center;
        }

        /* ── Entrance Animations ── */
        .terms-header > *, .terms-content {
            opacity: 0;
            transform: translateY(30px);
            animation: termsFadeUp 0.8s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }

        .terms-eyebrow {
            font-size: 0.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: #C8A84B;
            margin-bottom: 16px;
            display: block;
            animation-delay: 0.1s;
        }

        .terms-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(2.5rem, 6vw, 4.5rem);
            font-weight: 700;
            line-height: 1.1;
            color: #1A3329;
            margin-bottom: 24px;
            animation-delay: 0.2s;
        }

        .terms-header p {
            animation-delay: 0.3s;
        }

        .terms-content {
            background: #FFFFFF;
            padding: 60px;
            border-radius: 12px;
            border: 1px solid #E2E0DA;
            box-shadow: 0 10px 40px rgba(26, 51, 41, 0.04);
            animation-delay: 0.45s;
            
            /* Two Column Grid */
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            position: relative;
        }

        /* Vertical Divider */
        .terms-content::after {
            content: '';
            position: absolute;
            top: 60px;
            bottom: 60px;
            left: 50%;
            width: 1px;
            background: #E2E0DA;
            transform: translateX(-50%);
        }

        @keyframes termsFadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .terms-column {
            display: flex;
            flex-direction: column;
            gap: 40px;
        }

        .terms-section h2 {
            font-family: 'Cormorant Garamond', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: #1A3329;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .terms-section h2::before {
            content: '';
            width: 24px;
            height: 2px;
            background: #C8A84B;
        }

        .terms-section p {
            font-size: 1rem;
            line-height: 1.8;
            color: #6B6B62;
            margin-bottom: 20px;
        }

        .terms-section ul {
            list-style: none;
            padding-left: 0;
            margin-bottom: 20px;
        }

        .terms-section li {
            position: relative;
            padding-left: 28px;
            margin-bottom: 12px;
            color: #6B6B62;
            line-height: 1.6;
        }

        .terms-section li::before {
            content: '→';
            position: absolute;
            left: 0;
            color: #C8A84B;
            font-weight: 700;
        }

        @media (max-width: 1024px) {
            .terms-content {
                grid-template-columns: 1fr;
                gap: 40px;
                padding: 40px;
            }
            .terms-content::after {
                display: none;
            }
        }

        @media (max-width: 768px) {
            .terms-container {
                padding: 120px 24px 80px;
            }
            .terms-header {
                text-align: left;
            }
        }
    </style>
</head>
<body>
   

    <main class="terms-container" id="terms" aria-label="Kushtet dhe Termat - AgroFanema">
        <header class="terms-header">
            <span class="terms-eyebrow">Legal Agreement</span>
            <h1 class="terms-title">Terms of Conditions</h1>
            <p style="color: #6B6B62; font-size: 0.9rem;">Effective Date: March 20, 2026</p>
        </header>

        <div class="terms-content">
            <!-- Left Column -->
            <div class="terms-column">
                <section class="terms-section">
                    <h2>1. Acceptance of Terms</h2>
                    <p>By accessing and using the GreenGrow Fertilizers website, you agree to be bound by these Terms of Conditions. If you do not agree with any part of these terms, you must not use our services or products.</p>
                </section>

                <section class="terms-section">
                    <h2>2. Product Use</h2>
                    <p>Our premium organic fertilizers are designed for specific agricultural applications. Users are responsible for following all application guidelines provided on product labels and complying with local environmental regulations.</p>
                </section>
            </div>

            <!-- Right Column -->
            <div class="terms-column">
                <section class="terms-section">
                    <h2>3. Intellectual Property</h2>
                    <p>All content on this website, including designs, text, graphics, and logos, is the property of GreenGrow Fertilizer Co. and is protected by international copyright laws. Unauthorized use is strictly prohibited.</p>
                </section>

                <section class="terms-section">
                    <h2>4. Limitation of Liability</h2>
                    <p>GreenGrow Fertilizer Co. shall not be liable for any indirect, incidental, or consequential damages resulting from the use or inability to use our products or website services.</p>
                </section>
            </div>
        </div>
    </main>



    <script>
        // Remove active class from navlinks on the Terms page
        document.addEventListener('DOMContentLoaded', function() {
            const activeLinks = document.querySelectorAll('.gg-nav-scope .active');
            activeLinks.forEach(link => {
                link.classList.remove('active');
            });
        });
    </script>
</body>
</html>