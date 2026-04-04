<?php 
require_once 'essentials/db_connect.php';
require_once 'essentials/translations.php'; 
?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo t('about_meta_title'); ?></title>
    <meta name="description" content="<?php echo t('about_meta_desc'); ?>">
    <meta name="keywords" content="AgroFanema, rreth nesh, plehra organike, bujqësi">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://agrofanema.com/about.php">
    <meta property="og:title" content="Rreth Nesh | AgroFanema">
    <meta property="og:description" content="Misioni ynë është të mbështesim fermerët me zgjidhje organike të qëndrueshme.">
    <meta property="og:image" content="https://agrofanema.com/images/logo.svg">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:title" content="Rreth Nesh | AgroFanema">
    <meta property="twitter:description" content="Zbuloni rrugëtimin tonë në prodhimin e plehrave organike.">
    <meta property="twitter:image" content="https://agrofanema.com/images/logo.svg">

    <!-- Favicon -->
    <link rel="icon" type="image/svg+xml" href="images/favicon.svg">
    <link rel="apple-touch-icon" href="images/favicon.svg">

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
    <?php include "page-sections/about-sections/about-us-section.php" ?>
    <?php include "essentials/footer.php" ?>
    
</body>
</html>