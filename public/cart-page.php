<?php
    session_start();
    require '../db/db_connection.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        $selectedProducts = $_POST['select_merch'] ?? [];
        
        //Create individual
        if(isset($_POST['order-btn'])){
            $customer_id = $_SESSION['customer-id'];
            if($_POST['order-btn'] == 'save-order'){
                if(!empty($_POST['select-merch'])){
                    foreach ($_POST['select-merch'] as $selected){
                        $merchId = $_POST['merch-id'][$selected];
                        $name = $_POST['name'][$selected];
                        $price = $_POST['price'][$selected];
                        $quantity = $_POST['quantity'][$selected];
                        $path = $_POST['path'][$selected];
                        $total = $price * $quantity;
                        $size = $_POST['size'][$selected];


                        $newStmt = $conn->prepare('INSERT INTO order_summary(order_customer_id, order_name, order_price, order_quantity, order_total, order_path, order_size)
                        VALUES(?, ?, ?, ?, ?, ?, ?) 
                                                    ON DUPLICATE KEY UPDATE order_quantity = order_quantity + VALUES(order_quantity),
                                                    order_total = order_total + VALUES(order_total)');
                        $newStmt->bind_param('isssdss', $customer_id, $name, $price, $quantity, $total, $path, $size);
                        $newStmt->execute();

                        $updateStmt = $conn->prepare('UPDATE customer_cart SET merch_quantity = ?, merch_total = ? WHERE customer_id = ? AND merch_id = ? AND merch_size = ?');
                        $updateStmt->bind_param('idiis', $quantity, $total, $customer_id, $merchId, $size);
                        $updateStmt->execute();
                        
                        header('Location: '. $_SERVER['PHP_SELF']);
                        exit;
                    }
                }
            }elseif($_POST['order-btn'] == 'delete-merch'){
                if(!empty($_POST['select-merch'])){
                    foreach ($_POST['select-merch'] as $selected){
                        $merchId = $_POST['merch-id'][$selected];
                        $name = $_POST['name'][$selected];
                        $price = $_POST['price'][$selected];
                        $quantity = $_POST['quantity'][$selected];
                        $path = $_POST['path'][$selected];
                        $total = $price * $quantity;
                        $size = $_POST['size'][$selected];


                        $deleteStmt = $conn->prepare('DELETE FROM customer_cart WHERE customer_id = ? AND merch_id = ? AND merch_size = ?');
                        $deleteStmt->bind_param('iis', $customer_id, $merchId, $size);
                        $deleteStmt->execute();

                        header('Location: '. $_SERVER['PHP_SELF']);
                        exit;
                    }
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - Geloverse.dev</title>
    <link rel="stylesheet" href="../css/cart-page.css" class="css">
</head>
<body>
    <div class="main-cart-page">
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
        <?php include '../templates/header.php' ?>
        <div class="added-merch-list">
            <form class="added-merch" method="POST">
                <div class="column-name">
                    <p id="merch-detail-column">Merch Details</p>
                    <p id="quantity-column">Quantity</p>
                    <p id="price-column">Price</p>
                    <p id="total-column">Total</p>
                    <p id="select-column">Select</p>
                </div>
                <?php 
                    
                    $stmt = $conn->prepare('SELECT * FROM customer_cart WHERE customer_id = ?');
                    $stmt->bind_param('i', $_SESSION['customer-id']);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    while($row = $result->fetch_assoc()):
                ?>
                <div class="merch-added-card">
                    <div class="merch-detail">
                        <input type="hidden" name="merch-id[<?= $row['cart_id'] ?>]" value="<?= $row['merch_id'] ?>">
                        <img src="<?= $row['merch_path'] ?>" alt="">
                        <input type="hidden" name="path[<?= $row['cart_id'] ?>]" value="<?= $row['merch_path'] ?>">
                        <div class="detail-text">
                            <h2><?= $row['merch_name'] ?></h2>
                            <input type="hidden" name="name[<?= $row['cart_id'] ?>]" value="<?= $row['merch_name'] ?>">
                            <p>
                                <?= $row['merch_size'] ?>
                            </p>
                            <input type="hidden" name="size[<?= $row['cart_id'] ?>]" value="<?= $row['merch_size'] ?>">
                        </div>
                    </div>
                    <div class="merch-quantity">
                        <p class="operation minus-quant">-</p>
                        <p class="quantity-value"><?= $row['merch_quantity']  ?></p>
                        <input type="hidden" name="quantity[<?= $row['cart_id'] ?>]" value="<?= $row['merch_quantity'] ?>">
                        <p class="operation plus-quant">+</p>
                    </div>
                    <div class="merch-price">
                        <p>Php <?= $row['merch_price'] ?></p>
                        <input type="hidden" name="price[<?= $row['cart_id'] ?>]" value="<?= $row['merch_price'] ?>">
                    </div>
                    <div class="merch-total">
                        <p>Php <?= $row['merch_total'] ?></p>
                        <input type="hidden" name="total[<?= $row['cart_id'] ?>]" value="<?= $row['merch_total'] ?>">
                    </div>
                    <div class="merch-select">
                        <input type="checkbox" name="select-merch[]" value="<?= $row['cart_id'] ?>">
                    </div>
                </div>
                <?php endwhile; ?>
                <div class="select-button">
                    <button type="submit" name="order-btn" value="save-order">Select Merch</button>
                    <button type="submit" name="order-btn" value="delete-merch" id="del-btn">Remove Merch</button>
                </div>
                    </form>
            <div class="order-summary">
                <h1>Order Summary</h1>
                <div class="delivery-info">
                    <p>Location: <span><?= $_SESSION['location-add'] ?></span> </p>
                    <p>Courier: J&T Express Philippines</p>
                </div>
                <div class="no-item">
                    <p>Total Item: <span></span></p>
                </div>
                
                <?php 
                    $orderStmt = $conn->prepare('SELECT * FROM order_summary WHERE order_customer_id = ?');
                    $orderStmt->bind_param('i', $_SESSION['customer-id']);
                    $orderStmt->execute();
                    $result = $orderStmt->get_result();

                    $_SESSION['total-cost'] = 0.00;

                    while($row = $result->fetch_assoc()):

                        $_SESSION['total-cost'] += (float) $row['order_total']; 
                ?>
                <div class="order-card">
                    <img src="<?= $row['order_path'] ?>" alt="">
                    <div class="order-detail">
                        <h4><?= $row['order_name'] ?></h4>
                        <p>Item : <?= $row['order_quantity'] ?></p>
                        <p>Total : Php <?= $row['order_total'] ?></p>
                    </div>
                </div>
                <?php endwhile; ?>
                <div class="shipping">
                    <label for="payment">Shipping:</label>
                    <select id="payment" name="payment">
                        <option value="">--Please choose an option--</option>
                        <option value="gcash">Gcash</option>
                        <option value="paymaya">Paymaya</option>
                        <option value="paypal">Paypal</option>
                        <option value="cod">Cash on Delivery(COD)</option>
                    </select>
                </div>
                <div class="voucher">
                    <p>Enter voucher:</p>
                    <input type="text" name="voucher">
                    <button type="button">Apply Voucher</button>
                </div>
                <div class="final-total">
                    <p>Total Cost:  </p>
                    <p>Php <?= number_format($_SESSION['total-cost'], 2); ?></p>
                </div>
                <button type="button" name="buy-now" id="buy">Buy Now</button>
            </div>
                
        </div>
    </div>
    <script src="../js/customer-page.js"></script>
    <!--<script src="../js/customer-page.js"></script>-->
</body>
</html>