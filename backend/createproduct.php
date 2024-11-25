<?php
// importing file for connecting to database
require 'connect_db.php';
//checking if connection was successful
if($conn->connect_error){
    $error = 'Connection failed with :'.$conn->connect_error;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $product = json_decode(file_get_contents('php://input'), true);

   $product_name = isset($product['product_name']) ? trim($product['product_name']) : '';
    $product_price = isset($product['product_price']) ? trim($product['product_price']) : '';
    $product_description = isset($product['product_description']) ? trim($product['product_description']) : '';
    $product_type = isset($product['product_type']) ? trim($product['product_type']) : '';
    $product_image = isset($product['product_image']) ? trim($product['product_image']) : '';


    if(empty($product_name) || empty($product_price) || empty($product_description) || empty($product_type) || empty($product_image))
    {
        die('All fields are required');
    } else{

        //inserting data into the database (in robots voice)
        $stmt = $conn->prepare("INSERT INTO product (product_name, product_description, product_type, product_quantity, product_price, product_image) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $product_name, $product_description, $product_type, $product_quantity, $product_price, $product_image);

        if ($stmt->execute()) {
            echo json_encode(['code' => 1, 'message' => 'Product created successfully']);
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();

    }


}

$conn->close();

?>