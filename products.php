<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products | GreenGrow Fertilizers</title>
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
    <?php include "page-sections/products-section/categories-section.php" ?>
    <?php include "page-sections/products-section/all-products-grid.php" ?>
    <?php include "essentials/footer.php" ?>

    <script>
        // Update active navlink for Products page
        document.addEventListener('DOMContentLoaded', function() {
            const navLinks = document.querySelectorAll('.gg-nav-scope .nav-links a, .gg-nav-scope .dropdown-menu a');
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === 'products.php') {
                    link.classList.add('active');
                }
            });
        });
    </script>
</body>
</html>