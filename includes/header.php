<?php
require_once 'functions.php';

// Set default title and description if not set
if (!isset($pageTitle)) {
    $pageTitle = SITE_NAME;
}

if (!isset($pageDescription)) {
    $pageDescription = SITE_DESCRIPTION;
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <meta name="description" content="<?php echo $pageDescription; ?>">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Sarabun:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Favicon -->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

    <?php if (isset($additionalHead)) echo $additionalHead; ?>
</head>
<body>
    <header class="site-header">
        <div class="container">
            <div class="header-inner">
                <div class="logo">
                    <a href="index.php">
                        <img src="https://ext.same-assets.com/710686133/2761873112.png" alt="FutureSkill Logo" class="logo-image">
                    </a>
                </div>

                <nav class="main-nav">
                    <ul class="nav-menu">
                        <li class="nav-item <?php echo getActiveClass('/upskill'); ?>">
                            <a href="upskill.php" class="nav-link">UPSKILL</a>
                        </li>
                        <li class="nav-item <?php echo getActiveClass('/digital-marketing'); ?>">
                            <a href="category.php?slug=digital-marketing" class="nav-link">การตลาดออนไลน์</a>
                        </li>
                        <li class="nav-item <?php echo getActiveClass('/business'); ?>">
                            <a href="category.php?slug=business" class="nav-link">ธุรกิจ</a>
                        </li>
                        <li class="nav-item <?php echo getActiveClass('/finance-investment'); ?>">
                            <a href="category.php?slug=finance-investment" class="nav-link">การเงิน & การลงทุน</a>
                        </li>
                        <li class="nav-item <?php echo getActiveClass('/soft-skills'); ?>">
                            <a href="category.php?slug=soft-skills" class="nav-link">ทักษะ Soft Skills</a>
                        </li>
                        <li class="nav-item <?php echo getActiveClass('/office-productivity'); ?>">
                            <a href="category.php?slug=office-productivity" class="nav-link">Office Productivity</a>
                        </li>
                        <li class="nav-item <?php echo getActiveClass('/data'); ?>">
                            <a href="category.php?slug=data" class="nav-link">Data</a>
                        </li>
                        <li class="nav-item more-menu">
                            <a href="#" class="nav-link">
                                <i class="fas fa-ellipsis-h"></i>
                            </a>
                            <div class="dropdown-menu">
                                <ul>
                                    <li><a href="category.php?slug=programming">การเขียนโปรแกรม</a></li>
                                    <li><a href="category.php?slug=software-development">การพัฒนาซอฟต์แวร์</a></li>
                                    <li><a href="category.php?slug=game-development">พัฒนาเกม</a></li>
                                    <li><a href="category.php?slug=framework">Framework ต่างๆ</a></li>
                                    <li><a href="category.php?slug=it-software">IT and Software</a></li>
                                    <li><a href="category.php?slug=design">ออกแบบ</a></li>
                                    <li><a href="category.php?slug=art-craft">Art & Craft</a></li>
                                    <li><a href="category.php?slug=writing">การเขียน</a></li>
                                    <li><a href="category.php?slug=photography-video">Photography & Video</a></li>
                                    <li><a href="category.php?slug=language">ภาษา</a></li>
                                    <li><a href="category.php?slug=lifestyles">Lifestyles</a></li>
                                    <li><a href="category.php?slug=free-courses">คอร์สเรียนฟรี</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </nav>

                <div class="header-right">
                    <div class="search-box">
                        <form action="search.php" method="GET">
                            <input type="text" name="q" placeholder="ค้นหา..." class="search-input">
                            <button type="submit" class="search-button">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>

                    <div class="cart-icon">
                        <a href="cart.php">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-count">0</span>
                        </a>
                    </div>

                    <div class="user-menu">
                        <a href="login.php" class="login-link">เข้าสู่ระบบ</a>
                        <a href="register.php" class="register-link">สมัครสมาชิก</a>
                    </div>
                </div>

                <div class="mobile-menu-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </header>

    <div class="mobile-menu">
        <div class="container">
            <ul class="mobile-nav-menu">
                <li><a href="upskill.php">UPSKILL</a></li>
                <li><a href="category.php?slug=digital-marketing">การตลาดออนไลน์</a></li>
                <li><a href="category.php?slug=business">ธุรกิจ</a></li>
                <li><a href="category.php?slug=finance-investment">การเงิน & การลงทุน</a></li>
                <li><a href="category.php?slug=soft-skills">ทักษะ Soft Skills</a></li>
                <li><a href="category.php?slug=office-productivity">Office Productivity</a></li>
                <li><a href="category.php?slug=data">Data</a></li>
                <li><a href="category.php?slug=programming">การเขียนโปรแกรม</a></li>
                <li><a href="category.php?slug=software-development">การพัฒนาซอฟต์แวร์</a></li>
                <li><a href="category.php?slug=game-development">พัฒนาเกม</a></li>
                <li><a href="category.php?slug=framework">Framework ต่างๆ</a></li>
                <li><a href="category.php?slug=it-software">IT and Software</a></li>
                <li><a href="category.php?slug=design">ออกแบบ</a></li>
                <li><a href="category.php?slug=art-craft">Art & Craft</a></li>
                <li><a href="category.php?slug=writing">การเขียน</a></li>
                <li><a href="category.php?slug=photography-video">Photography & Video</a></li>
                <li><a href="category.php?slug=language">ภาษา</a></li>
                <li><a href="category.php?slug=lifestyles">Lifestyles</a></li>
                <li><a href="category.php?slug=free-courses">คอร์สเรียนฟรี</a></li>
            </ul>

            <div class="mobile-user-menu">
                <a href="login.php" class="login-link">เข้าสู่ระบบ</a>
                <a href="register.php" class="register-link">สมัครสมาชิก</a>
            </div>
        </div>
    </div>

    <main class="site-main"><?php // Content will go here ?>
