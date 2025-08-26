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
                <img src="assets/icons/info.png" alt="info icon" onclick="openOverlay()">
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
                <a href="#home"><li>Home</li></a>
                <a href="#merch"><li>Merch</li></a>
                <a href="#about"><li>About</li></a>
                <a href="#contact"><li>Contact</li></a>
                <a onclick="openOverlay()"><li>Help</li></a>
            </ul>
        </div>
        <div class="cart bar">
            <div class="cart-btn">
                <!--<p>Cart</p>-->
                <a href="public/login.php">
                    <img src="assets/icons/cart-icon.png" alt="Cart icon">
                </a>
            </div>
            <a href="public/login.php" class="log-btn">
                <p>Login</p>
                <img src="assets/icons/acc-icon.png" alt="account icon">
            </a>
        </div>
    </div>
    <div class="home-primary-sec" id="home">
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
            <div class="shop-feature">
                <div class="feature-card">
                    <p>Locally designed and carefully printed with love, ensuring every piece is made with passion and creativity. ₱999 and above!</p>
                </div>
                <div class="feature-card">
                    <p>Enjoy free next-day delivery on all orders worth ₱999 and above, bringing your favorites right to your doorstep.</p>
                </div>
                <div class="feature-card">
                    <p>We are open and ready to serve you from Monday to Saturday, between 9:00 AM and 6:00 PM.</p>
                </div>
            </div>
            <h1 id="merch">Top Merch 2025</h1>
            <div class="shop-top-merch">
                
                <div class="top-merch-details">
                    <div class="details-sides side-1">
                        <p>Drinkware</p>
                        <h1>Daily Brew Mug(White)</h1>
                        <p>A stylish 350ml ceramic mug, designed with a sleek minimalist print. Built to be both microwave and dishwasher safe, it’s perfect for everyday use at home or in the office.</p>
                    </div>
                    <div class="details-sides side-2">
                        <p>Accesories</p>
                        <h1>Wired Mouse(Black)</h1>
                        <p>Enjoy a smooth and silent clicking experience with this ergonomic wireless mouse. Powered by a 2.4GHz USB dongle for instant plug-and-play connectivity, it’s designed for comfort and efficiency all day long.</p>
                    </div>
                </div>
                <div class="top-merch-image">
                    <p>Apparel</p>
                    <h1>Oversized Hoodie(Black)</h1>
                    <p>Made from premium heavyweight fleece with a cozy kangaroo pocket and relaxed drop-shoulder fit — the ultimate blend of style and warmth, perfect for keeping you comfortable during chilly days and cool nights.</p>
                </div>
            </div>
        </div>
        <div class="about-us" id="about">
            <div class="map-img"></div>
            <div class="about-texts">
                <div class="about-text-sides">
                    <h1>Geloverse.dev</h1>
                    <p>Welcome to Geloverse.dev — where design meets delight.
                        We're more than just an online shop; we're a universe of creativity for coffee lovers, design enthusiasts, and anyone who believes everyday items should feel personal and beautiful.</p>
                    <p>Born from a passion for unique aesthetics and functional design, Geloverse.ui offers a curated selection of merchandise — from statement mugs and cozy apparel to minimalist accessories — all thoughtfully crafted to fit your style.</p>
                </div>
                <div class="about-text-sides text-sides-2">
                    <h3>Our mission is simple:</h3>
                    <p>Make your daily coffee moments better</p>
                    <p>Bring UI-inspired elegance into real life</p>
                    <p>Create products that spark joy every time you use them</p>
                    <p>Whether you’re treating yourself or looking for the perfect gift, Geloverse.dev is here to make online shopping smooth, secure, and satisfying. We believe that great products should be paired with an even greater shopping experience — so every step, from browsing to unboxing, is designed with you in mind.</p>
                </div>
            </div>
        </div>
        <div class="contact-us" id="contact">
            <h1>Contact-us</h1>
            <div class="info-texts">
                <div class="contact-sides">
                    <div class="contact-info">
                        <h2>GIVE US CALL</h2>
                        <p>+63 915 671 6663</p>
                    </div>
                    <div class="contact-info">
                        <h2>Email Us</h2>
                        <p>geloverse.dev@gmail.com</p>
                    </div>
                    <div class="contact-info">
                        <h2>Visit as</h2>
                        <p>Sitio Bagong Purok, Antipolo City, 1870 Rizal</p>
                    </div>
                </div>
                <form class="contact-sides send-message">
                        <h2>SEND US MESSAGE</h2>
                        <input type="text" name="name" placeholder="Name" required>
                        <input type="text" name="email" placeholder="Email" required>
                        <textarea name="message" id="message" placeholder="Message"></textarea>
                        <button type="submit">Send message</button>
                </form>
            </div>
        </div>
        <div class="help-center-popup" id="help-center-popup">
            <div class="popup-page">
                <div class="page-sec">
                    <h1>Help Center – Geloverse.ui</h1>
                    <p>Welcome to the Geloverse.ui Help Center</p>
                    <p>We’re here to make your shopping experience as smooth as possible. Whether you have questions about your order, shipping, or our products, you’ll find answers here.</p>
                </div>
                <div class="page-sec">
                    <h1>Orders & Shipping</h1>
                    <p>How to Place an Order</p>
                    <ol>
                        <li>Browse our products and click Add to Cart.</li>
                        <li>When ready, click the cart icon and proceed to Checkout.</li>
                        <li>Fill in your shipping details, choose a payment method, and confirm your order.</li>
                    </ol>
                    <p>Shipping Information & Rates</p>
                    <ul>
                        <li>We ship nationwide via trusted couriers.</li>
                        <li>Standard shipping: 3-7 business days./li>
                        <li>Express shipping: 1–3 business days (additional fees apply).</li>
                    </ul>
                    <p>Track Your Order</p>
                    <p>Once your order ships, you’ll receive a tracking number via email or SMS. Use it to check your order status on our courier’s website.</p>
                </div>
                <div class="page-sec">
                    <h1>Returns & Exchanges</h1>
                    <p>Return Policy</p>
                    <ul>
                        <li>Returns are accepted within 7 days of delivery.</li>
                        <li>Item must be unused, in original packaging, and with proof of purchase.</li>
                    </ul>
                    <p>How to Request a Return</p>
                    <ol>
                        <li>Contact us at support@geloverseui.com with your order number and reason for return.</li>
                        <li>Wait for confirmation and return instructions./li>
                        <li>Ship the product back to us for inspection and processing.</li>
                    </ol>
                    <p>Refund Processing Time</p>
                    <p>Approved refunds are processed within 5–7 business days.</p>
                </div>
                <div class="page-sec">
                    <h1>Account & Payments</h1>
                    <p>Creating an Account</p>
                    <ul>
                        <li>Click Sign Up on the top right of the homepage.</li>
                        <li>Fill in your name, email, and password.</li>
                        <li>Verify your email to activate your account.</li>
                    </ul>
                    <p>Accepted Payment Methods</p>
                    <ul>
                        <li>Credit/Debit Cards (Visa, MasterCard)</li>
                        <li>GCash / PayMaya</li>
                        <li>Bank Transfer</li>
                        <li>Cash on Delivery (COD) – selected locations only</li>
                    </ul>
                    <p>Payment Troubleshooting</p>
                    <p>If your payment fails, double-check your details, try another method, or contact your bank.</p>
                </div>
                <div class="page-sec">
                    <h1>Product Support</h1>
                    <p>Product Care Instructions</p>
                    <ol>
                        <li>Ceramic mugs: Microwave & dishwasher safe.</li>
                        <li>Apparel: Machine wash cold, tumble dry low.</li>
                        <li>Accessories: Wipe clean with a damp cloth.</li>
                    </ol>
                    <p>Size Guide</p>
                    <p>Check our Size Guide page before ordering apparel to ensure the perfect fit.</p>
                    <p>Warranty</p>
                    <p>Some items come with a 30-day warranty for manufacturing defects.</p>
                </div>
                <div class="page-sec">
                    <h1>Contact Support</h1>
                    <p>Product Care Instructions</p>
                    <p>Email Us: support@geloverseui.com</p>
                    <p>Live Chat: Available Mon–Fri, 9 AM–6 PM</p>
                    <p>FAQ: Visit our FAQ page for quick answers.y</p>
                </div>
                <div class="close-popup" onclick="closeOverlay()">
                    <p>Exit Help Center</p>
                </div>
            </div>
        </div>
            
        <img src="assets/Vector.png" class="wave"  alt="wave image">
    </div>
    <?php include 'templates/footer.php'; ?>
    <script>
        function checkFadeIn() {
            document.querySelectorAll('.fade-in').forEach(el => {
                const rect = el.getBoundingClientRect();
                if (rect.top < window.innerHeight - 50) {
                el.classList.add('visible');
                }
            });
            }

        window.addEventListener('DOMContentLoaded', checkFadeIn);
        //window.addEventListener('scroll', checkFadeIn);


        function openOverlay() {
            document.getElementById("help-center-popup").style.display = "flex"; // show overlay
            document.body.style.overflow = "hidden"; // disable background scroll
        }

        function closeOverlay(){
            document.getElementById("help-center-popup").style.display = "none"
            document.body.style.overflow = ""; // disable background scroll
        }
    </script>
</body>
</html>