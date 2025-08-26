<?php
    session_start();
    require '../db/db_connection.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
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

        if($_POST['save-address']){

            $stmt = $conn->prepare('INSERT INTO delivery_information(customer_id, fullname, phone, full_add, street_add, barangay, city, region, code, landmark) VALUE (?, ?, ?, ?, ?, ?, ?, ? , ?, ?)');
            $stmt->bind_param('issssssssi', $customer_id, $fullname, $phone, $fullAdd, $street, $baranggay, $city, $region, $code, $landmark);
            $stmt->execute();
            $stmt->close();

            header('Location: ../public/customer_page.php');
        }   


    }


?>