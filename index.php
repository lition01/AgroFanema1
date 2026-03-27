<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GreenGrow Fertilizers</title>
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
    </style>
</head>
<body>
    <?php include "essentials/navbar.php" ?>
    <?php include "page-sections/index-sections/hero-section.php" ?>
    <?php include "page-sections/index-sections/about-preview-section.php" ?>
    <?php include "page-sections/index-sections/top-products-section.php" ?>
    <?php include "page-sections/index-sections/statistics-section.php" ?>
    <?php include "page-sections/index-sections/benefits-section.php" ?>
    <?php include "page-sections/index-sections/FAQ-section.php" ?>
    <?php include "essentials/footer.php" ?>
</body>
</html>