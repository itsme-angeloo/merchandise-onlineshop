<div class="main-header">
    <div class="header-left-section header-side">
                <div class="header-section header-logo">
                    <a href="../public/customer_page.php"><h1>Geloverse.dev</h1></a>
                    <p>codewear for the creative dev.</p>
                </div>
                <div class="header-section">
                    <img src="../assets/icons//location.png" alt="location png">
                    <p onclick="openSetAddress()"><?= $_SESSION['location-add'] ?></p>
                </div>
            </div>
            <div class="header-right-section header-side">
                <div class="header-section">
                    <p onclick="editShow()">Edit</p>
                    <p id="done" onclick="editUnshow()">Done</p>
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