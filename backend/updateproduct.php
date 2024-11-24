<?php

// importing file for connecting to database
require 'connect_db.php';

if($conn->connect_error){
    $error = 'Connection failed with :'.$conn->connect_error;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    //decoding the json data sent to the server
    $product = json_decode(file_get_contents('php://input'), true);

    //for updating we need the user to update all fields for the product
    $product_id = trim($product['product_id']);
    $product_name = trim($product['product_name']);
    $product_price = trim($product['product_price']);
    $product_description = trim($product['product_description']);
    $product_type = trim($product['product_type']);
    $product_image = trim($product['product_image']);

    if(empty($product_id) || empty($product_name) || empty($product_price) || empty($product_description) || empty($product_type) || empty($product_image))
    {
        die('All fields are required');
    } else{

        //updating data into the database using the product id
        $stmt = $conn->prepare("UPDATE product SET product_name = ?, product_price = ?, product_description = ?, product_type = ?, product_image = ? WHERE product_id = ?");
        $stmt->bind_param("ssssss", $product_name, $product_price, $product_description, $product_type, $product_image, $product_id);

        if ($stmt->execute()) {
            echo json_encode(['code' => 1, 'message' => 'Product updated successfully']);
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();

    }
}

$conn->close();

?>