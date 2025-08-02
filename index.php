<?php 



// index.php
$url = $_GET['url'] ?? 'home';

switch ($url) {
    case 'shop':
        include 'public/shop.php';
        break;
    case 'about':
        include 'public/about.php';
        break;
    default:
        include 'public/home.php';
        break;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geloverse.dev Merch</title>
    <link rel="stylesheet" href="css/index.css" class="css">
</head>
<body>
    <div class="header">
        <div class="header-btn1 header-btns">

        </div>
        <div class="header-btn2 header-btns">
            <h1>geloverse.dev</h1>
        </div>
        <div class="header-btn3 header-btns">
            <div class="faqs-btn">
                <p>FAQs</p>
                <img src="assets/icons/info.png" alt="info icon">
            </div>
        </div>
            
    </div>
    <div class="nav-bar">
        <div class="search-bar bar">
            <div class="search">
                <input type="text" name="search" placeholder="Search...">
                <img src="assets/icons/search.png" alt="search icon">
            </div>
            </div>
        <div class="nav-area bar">
            <ul>
                <a><li>Home</li></a>
                <a><li>Shop</li></a>
                <a><li>About</li></a>
                <a><li>Contact</li></a>
                <a><li>Help</li></a>
            </ul>
        </div>
        <div class="cart bar">
            <div class="cart-btn">
                <!--<p>Cart</p>-->
                <img src="assets/icons/cart-icon.png" alt="Cart icon">
            </div>
            <a href="public/login.php" class="log-btn">
                <p>Login</p>
                <img src="assets/icons/acc-icon.png" alt="account icon">
            </a>
        </div>
    </div>
    <div class="home-primary-sec">
        <div class="primary-sec-lp fade-in">
            <div class="glass-card">
                <div class="l-con">
                    <div class="upper-text r-con-text">
                        <p>Save up to 30% on your favorite items! Shop now and enjoy exclusive deals on quality products you’ll love. Limited-time offers — don’t miss out!</p>
                    </div>
                    <div class="center-text">
                    </div>
                    <div class="lower-text">
                        <p>— where tech meets style.</p>
                    </div>
                </div>
                <div class="center-con">
                    <div class="shopnow-btn">
                        <p>Shop Now</p>
                        <img src="assets/icons/cart-icon.png" alt="shop bag icon">
                    </div>
                </div>
                <div class="r-con">
                    <div class="upper-text r-con-text">
                        <p>Explore a universe of clean, witty, and minimalist merch crafted for devs, creatives, and coffee lovers.</p>
                    </div>
                    <div class="center-text">
                        
                    </div>
                    <div class="lower-text">
                        <p>Shirts, mugs, and more — designed with code, built with love.</p>
                    </div>
                </div>
            </div>
            
        </div>
        <div class="shop-content">
            
        </div>
        <img src="assets/Vector.png" class="wave"  alt="wave image">
    </div>
    <script>
        window.addEventListener('scroll', () => {
            document.querySelectorAll('.fade-in').forEach(el => {
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight - 50) {
                el.classList.add('visible');
                }
            });
        });
    </script>
</body>
</html>