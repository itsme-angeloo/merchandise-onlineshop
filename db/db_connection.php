<?php

    $host = 'localhost';
    $name = 'root';
    $password = 'Loreno@2003';
    $db_name = 'onlineshop_db';

    $conn = new mysqli($host, $name, $password, $db_name);

    if($conn->connect_error){
        die('Connection Failed' . $conn->connect_error);
    }
?>