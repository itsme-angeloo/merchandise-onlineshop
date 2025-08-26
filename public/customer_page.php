<?php
    session_start();
    require '../db/db_connection.php';

    if(!($_SESSION['loggedin'])){
        header('Loction: login.php');
    }

    $activeCategory = $_GET['category'] ?? 'All';

    $getLocStmt = $conn->prepare('SELECT * FROM delivery_information
                                JOIN users ON delivery_information.delivery_id = users.id
                                WHERE id = ?;
                                ');
    $getLocStmt->bind_param('i', $_SESSION['customer-id']);
    $getLocStmt->execute();
    $result = $getLocStmt->get_result();
    $row = $result->fetch_assoc();

    $_SESSION['location-add'] = $row['full_add'] ?? 'Click to start your delivery information';

    $locationAdd = $_SESSION['location-add'];
    $merchName = '';
    $merchPath = '';
    $merchCategory = '';
    $merchDescription = '';
    $merchPrice = '';
    $merchId = '';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        if(isset($_POST['save-address'])){
            $customer_id = $_SESSION['customer-id'];
            $fullname = $_POST['fullname'];
            $phone = $_POST['phone-no'];
            $fullAdd = $_POST['location'];
            $street = $_POST['street'];
            $baranggay = $_POST['baranggay'];
            $city = $_POST['city'];
            $region = $_POST['region'];
            $code = $_POST['code'];
            $landmark = $_POST['landmark'];

            if($locationAdd == 'Click to start your delivery information'){
                $stmt = $conn->prepare('INSERT INTO delivery_information(customer_id, fullname, phone_no, full_add, street_add, barangay, city, region, code, landmark) VALUES (?, ?, ?, ?, ?, ?, ?, ? , ?, ?)');
                $stmt->bind_param('issssssssi', $customer_id, $fullname, $phone, $fullAdd, $street, $baranggay, $city, $region, $code, $landmark);
                $stmt->execute();
                $stmt->close();
            }else{
                $stmt = $conn->prepare('UPDATE delivery_information SET fullname = ?, phone_no = ?, full_add = ?, street_add = ?, barangay = ?, city = ?, region = ?, code = ?, landmark = ? WHERE customer_id = ?');
                $stmt->bind_param('ssssssssii', $fullname, $phone, $fullAdd, $street, $baranggay, $city, $region, $code, $landmark, $customer_id);
                $stmt->execute();
                $stmt->close();
            }
        }
        
        if(isset($_POST['show-merch'])){
            $merchName = $_POST['merch_name'];
            $merchPath = '../' . $_POST['image_path'];
            $merchCategory = $_POST['merch_category'];
            $merchDescription = $_POST['merch_description'];
            $merchPrice = $_POST['merch_price'];
            $merchId = $_POST['merch_id'];

        }

        if(isset($_POST['add-merch'])){
            $customerId = $_SESSION['customer-id'];
            $cartId = $_POST['cart-id'];
            $cartPath = $_POST['cart-path'];
            $cartName = $_POST['cart-name'];
            $cartCategory = $_POST['cart-category'];
            $cartQuantity = $_POST['cart-quantity'];
            $cartDescription = $_POST['cart-description'];
            $cartPrice = $_POST['cart-price'];
            $cartSize = $_POST['cart-size'];
            $cartTotal = $cartQuantity * $cartPrice;

            $stmt = $conn->prepare('INSERT INTO customer_cart(customer_id, merch_id, merch_name, merch_price, merch_quantity, merch_total, merch_path, merch_description, merch_category, merch_size) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE merch_quantity = merch_quantity + VALUES(merch_quantity),
                                    merch_total = merch_total + VALUES(merch_total)');
            $stmt->bind_param('iisiiissss', $customerId, $cartId, $cartName, $cartPrice, $cartQuantity, $cartTotal, $cartPath, $cartDescription, $cartCategory, $cartSize);
            $stmt->execute();
            $stmt->close();

            header('Location: ' . $_SERVER['PHP_SELF']);
            exit;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enjoy Shopping!</title>
    <link rel="stylesheet" href="../css/customer_page.css" class="css">
</head>
<body>
    <div class="main-page">
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
        <div class="set-address" id="set-location">
            <form action="" method="POST">
                <div class="set-address-header">
                    <h1>Set you delivery information</h1>
                    <img src="../assets/icons/close-icon.png" alt="close-icon" onclick="closeSetAddress()">
                </div>
                <div class="address-info-input">
                    <div class="info-input-left info-input">
                        <div class="fullname-inputs inputs">
                            <label for="fullname">Fullname:</label>
                            <input type="text" name="fullname" id="fullname" placeholder="e.g 'Angelo Garcia Loreno" required>
                        </div>
                        <div class="phone-inputs inputs">
                            <label for="phone-no">Phone Number:</label>
                            <input type="text" name="phone-no" id="phone-no" placeholder="+63" required>
                        </div>
                        <div class="location-inputs inputs">
                            <label for="location">Delivery Address:</label>
                            <input type="text" name="location" id="location" placeholder="Enter your full location address" required>
                        </div>
                        <div class="street-inputs inputs">
                            <label for="street">Street Address:</label>
                            <input type="text" name="street" id="street" placeholder="House number/Street name" required>
                        </div>
                        <div class="baranggay-inputs inputs">
                            <label for="baranggay">Baranggay:</label>
                            <input type="text" name="baranggay" id="baranggay" placeholder="Baranggay Name" required>
                        </div>
                    </div>
                    <div class="info-input-right info-input">
                        <div class="city-inputs inputs">
                            <label for="city">City/Municipality:</label>
                            <input type="text" name="city" id="city" placeholder="City/Municipality" required>
                        </div>
                        <div class="province-code-inputs inputs">
                            <div class="region-input ">
                                <label for="region">Province/Region:</label>
                                <input type="text" name="region" id="region" placeholder="Province" required>
                            </div>
                            <div class="code-input">
                                <label for="code">Zip Code:</label>
                                <input type="text" name="code" id="code" placeholder="XXXX" required>
                            </div>
                        </div>
                        <div class="landmark-inputs inputs">
                            <label for="landmark">Landmark(Optional):</label>
                            <textarea name="landmark" id="landmark" placeholder="e.g., Near 7-Eleven"></textarea>
                        </div>
                        <button type="submit" name="save-address">Save information</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="main-top">
            <div class="top-section">
                <p>Free Next Day Delivery on all orders ₱999 and above!</p>
            </div>
            <div class="top-section">
                <p>Locally designed & printed with love</p>
            </div>
            <div class="top-section">
                <p>Operating Hours: Mon–Sat | 9:00 AM – 6:00 PM</p>
            </div>
            <div class="top-section top-info-section" onclick="openOverlay()">
                <img src="../assets/icons/info.png" alt="Icon png">
            </div>
        </div>
        <div class="main-header">
            <div class="header-left-section header-side">
                <div class="header-section header-logo">
                    <h1>Geloverse.dev</h1>
                    <p>codewear for the creative dev.</p>
                </div>
                <div class="header-section">
                    <input type="text" name="search-product" placeholder="Search...">
                    <img class="search-img" src="../assets/icons/search.png" alt="search icon">
                </div>
                <div class="header-section">
                    <img src="../assets/icons//location.png" alt="location png">
                    <p onclick="openSetAddress()"><?= $_SESSION['location-add'] ?></p>
                </div>
            </div>
            <div class="header-right-section header-side">
                <div class="header-section">
                    <a href="cart-page.php"><img src="../assets/icons/cart-icon.png" alt="cart icon"></a>
                </div>
                <div class="header-section account-btn">
                    <img src="../assets/icons/acc-icon.png" alt="account icon">
                    <p class="my-account-btn"><?= $_SESSION['username']?></p>
                    <div class="logout-dropdown">
                        <a href="../includes/logout.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="product-page">
            <div class="nav-bar">
                <div class="nav-list <?= ($activeCategory == "All") ? 'active-category' : '' ?>">
                    <img src="../assets/icons/sorting.png" alt="sorting icon">
                    <a href="?category=All">Shop All Products</a>
                </div>
                <div class="nav-list <?= ($activeCategory == "Apparel") ? 'active-category' : '' ?>">
                    <img src="../assets/icons/apparel.png" alt="sorting icon">
                    <a href="?category=Apparel">Apparel</a>
                </div>
                <div class="nav-list <?= ($activeCategory == "Drinkware") ? 'active-category' : '' ?>">
                    <img src="../assets/icons/drinkware.png" alt="sorting icon">
                    <a href="?category=Drinkware">Drinkware</a>
                </div>
                <div class="nav-list <?= ($activeCategory == "Accesories") ? 'active-category' : '' ?>">
                    <img src="../assets/icons/accesories.png" alt="sorting icon">
                    <a href="?category=Accesories">Tech & Accesories</a>
                </div>
                <div class="nav-list <?= ($activeCategory == "Stationary") ? 'active-category' : '' ?>">
                    <img src="../assets/icons/stationary.png" alt="sorting icon">
                    <a href="?category=Stationary">Stationary</a>
                </div>
                
            </div>

            <!-- THIS IS THE PRODUCT, SIDE POP-UP -->
        
            <div class="product-section">

                <div class="proleft product-side fade-in">
                    <?php
                    if($activeCategory == 'All'){
                        $stmt = $conn->prepare('SELECT * FROM merchs_details ORDER BY id');
                    }else{
                        $stmt = $conn->prepare('SELECT * FROM merchs_details WHERE merch_category = ? ORDER BY id');
                        $stmt->bind_param('s', $activeCategory);
                    }

                    $stmt->execute();
                    $merch_data = $stmt->get_result();

                    while($row = $merch_data->fetch_assoc()):
                    ?>

                    <form action="" method='POST' class='product-card' id="product-card">
                        <div class="product_img" style="background: url('../<?= $row['image_path'] ?>'); background-repeat: no-repeat;
                        background-size: cover;
                        background-position: center;"></div>
                        <input type="hidden" name="merch_id" value="<?= $row['id'] ?>" style="display:none;">
                        <input type="hidden" name="merch_name" value="<?= $row['merch_name'] ?>" style="display:none;">
                        <input type="hidden" name="merch_category" value="<?= $row['merch_category'] ?>" style="display:none;">
                        <input type="hidden" name="image_path" value="<?= $row['image_path'] ?>" style="display:none;">
                        <input type="hidden" name="merch_description" value="<?= $row['merch_description'] ?>" style="display:none;">
                        <input type="hidden" name="merch_price" value="<?= $row['merch_price'] ?>" style="display:none;">
                        <p><?= $row['merch_category'] ?></p>
                        <h2><?= $row['merch_name'] ?></h2>
                        <p>Deliveres via trusted couriers</p>
                        <p class='price-value'>PHP <?= $row['merch_price'] ?></p>
                        <button class="add-cart-btn" id="add-cart-btn" name="show-merch" type="submit" value="1">
                            <img src="../assets/icons/cart-icon.png" alt="">
                            <p>Add to cart</p>
                        </button>
                    </form>
                    <?php endwhile; ?>
                </div>
                <div class="proright product-side">
                    <?php 
                        if($merchName == ''){
                            echo '<img class="proright-img1 fade-in" src="../assets/geloverse-promo-1.png" alt="image geloverse promo">';
                            echo '<img class="proright-img2 fade-in" src="../assets/geloverse-pro-2.png" alt="image geloverse promo">';
                        }else{
                            echo '<form method="POST" class="pro-add-sidepop" id="pro-add-sidepop">';
                                echo '<div class="product-img" style="background: url(\'../'. $merchPath . '\'); background-repeat: no-repeat;
                            background-size: cover;
                            background-position: center;">';
                            echo '<input type="hidden" name="cart-path" value="'. $merchPath .'">';
                            echo '</div>';
                                echo '<div class="input-merch-details">';
                                    echo '<p>' . $merchCategory . '</p>';
                                    echo '<input type="hidden" name="cart-category" value="'. $merchCategory .'">';
                                    echo '<h1>' . $merchName . '</h1>';
                                    echo '<input type="hidden" name="cart-name" value="'. $merchName .'">';
                                    echo '<p class="pop-description">' . $merchDescription . '</p>';
                                    echo '<input type="hidden" name="cart-description" value="'. $merchDescription .'">';
                                    echo '<input type="hidden" name="cart-price" value="'. $merchPrice .'">';
                                    echo '<input type="hidden" name="cart-id" value="'. $merchId .'">';
                                    echo '<div class="size">';
                                        echo '<p class="size-name">Size:</p>';
                                        echo '<div class="size-selector">';
                                            echo '<label class="size-box">';
                                                echo '<input type="radio" name="cart-size" value="S" required>';
                                                echo '<span>Small</span>';
                                            echo '</label>';
                                            echo '<label class="size-box">';
                                                echo '<input type="radio" name="cart-size" value="M" required>';
                                                echo '<span>Medium</span>';
                                            echo '</label>';
                                            echo '<label class="size-box">';
                                                echo '<input type="radio" name="cart-size" value="L" required>';
                                                echo '<span>Large</span>';
                                            echo '</label>';
                                        echo '</div>';
                                    echo '</div>';
                                    echo '<div class="quantity-control">';
                                        echo '<p class="quantity-name">Quantity: </p>';
                                        echo '<p id="minus-quantity">-</p>';
                                        echo '<p id="quantity-value">1</p>';
                                        echo '<input type="hidden" name="cart-quantity" id="quantity-hidden-value" value="1">';
                                        echo '<p id="plus-quantity">+</p>';
                                    echo '</div>';
                                    echo '<div class="add-merch-btn">';
                                        echo '<button  name="add-merch" type="submit" value="1">';
                                            echo '<img src="../assets/icons/cart-icon.png" alt="" width="50">';
                                            echo '<p>Add to cart</p>';
                                        echo '</button>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</form>';
                        }
                    ?>    
                    </div>
                    
                    
                </div>
            </div>
        </div>
        <footer>
            <div class="newsletter-section">
                <h2>Newsletter</h2>
                <p>Be the first to know about special offers and coffee-themed merch updates!</p>
                <form action="" method="POST">
                    <input type="email" name="email" placeholder="" value="<?= $_SESSION['email'] ?>">
                    <button type="button" name="subscribe">Subscribe</button>
                </form>
            </div>
            <div class="main-footer">
                <div class="main-footer-sections sec-1">
                    <h1>Geloverse.dev</h1>
                    <p>Coffee-inspired merchandise for developers & enthusiasts. Brew your style with us.</p>
                    <h4>Follow us:</h4>
                    <div class="soc-icons">
                        <img src="../assets/icons/facebook.png" alt="facebook icon">
                        <img src="../assets/icons/Instagram.png" alt="instagram icon">
                        <img src="../assets/icons/TikTok.png" alt="tiktok icon">
                    </div>
                </div>
                <div class="main-footer-sections">
                    <h4>Quick Links</h4>
                    <p>Shop</p>
                    <p>About</p>
                    <p>FAQs</p>
                    <p>Privacy Policy</p>
                </div>
                <div class="main-footer-sections">
                    <h4>Support</h4>
                    <p>Email: angelogarcialoreno@gmail.com</p>
                    <p>Hours: 9:00 AM - 6:00 PM</p>
                </div>
                <div class="main-footer-sections sec-4">
                    <h4>We accept</h4>
                    <div class="payment-icons">
                        <img src="../assets/gcash-logo.png" alt="gcash icon">
                        <img src="../assets/paypal-logo.png" alt="paypal icon">
                        <img src="../assets/maya-logo.png" alt="maya icon">
                        <img src="../assets/cod-logo.png" alt="cod icon">
                    </div>
                </div>
            </div>
            <div class="copyright-section">
                <p>&copy 2025 gelovers.dev. All Rights Reserved.</p>
            </div>
        </footer>
    </div>
    <script src="../js/customer-page.js"></script>
</body>
</html>