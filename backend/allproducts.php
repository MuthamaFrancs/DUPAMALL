<?php

// importing file for connecting to database
require 'connect_db.php';

if($conn->connect_error){
    $error = 'Connection failed with :'.$conn->connect_error;
}

if($_SERVER['REQUEST_METHOD'] === 'GET'){

    //selecting all products from the database so we expect an array of products
    $stmt = $conn->prepare("SELECT * FROM product ORDER BY product_id DESC");

    $stmt->execute();
    $result = $stmt->get_result();
    $products = [];

    while($row = $result->fetch_assoc()){
        $products[] = $row;
    }

    echo json_encode($products);

    $stmt->close();
}

?>