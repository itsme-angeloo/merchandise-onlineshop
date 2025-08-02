<?php
    session_start();
    require '../db/db_connection.php';

    if(!($_SESSION['loggedin'])){
        echo 'Hello' . $_SESSION['username'];
    }

    $activeCategory = $_GET['category'] ?? 'All';


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
            <div class="top-section top-info-section">
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
                    <p>Click to start your location</p>
                </div>
            </div>
            <div class="header-right-section header-side">
                <div class="header-section">
                    <img src="../assets/icons/cart-icon.png" alt="cart icon">
                </div>
                <div class="header-section">
                    <img src="../assets/icons/acc-icon.png" alt="account icon">
                    <p>My Account</p>
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
            <div class="product-section">
                <div class="proleft product-side">
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

                    <form action="" method='POST' class='product-card'>
                        <div class="product_img" style="background: url('../<?= $row['image_path'] ?>'); background-repeat: no-repeat;
                        background-size: cover;
                        background-position: center;"></div>
                        <p><?= $row['merch_category'] ?></p>
                        <h2><?= $row['merch_name'] ?></h2>
                        <p>Deliveres via trusted couriers</p>
                        <p class='price-value'>PHP <?= $row['merch_price'] ?></p>
                        <div class="add-cart-btn">
                            <img src="../assets/icons/cart-icon.png" alt="">
                            <p>Add to cart</p>
                        </div>
                    </form>
                    <?php endwhile; ?>
                </div>
                <div class="proright product-side">
                    <img class="proright-img1" src="../assets/geloverse-promo-1.png" alt="image geloverse promo">
                    <img class="proright-img2" src="../assets/geloverse-pro-2.png" alt="image geloverse promo">
                </div>
            </div>
        </div>
    </div>
</body>
</html>