<?php
// importing file for connecting to database
require 'connect_db.php';

//checking if connection was successful
if($conn->connect_error){
    $error = 'Connection failed with :'.$conn->connect_error;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    

        $response = [];    
    
        $product = json_decode(file_get_contents('php://input'), true);
        
        $product_name = isset($product['product_name']) ? trim($product['product_name']) : '';
        $product_price = isset($product['product_price']) ? trim($product['product_price']) : '';
        $product_quantity = isset($product['product_quantity']) ? trim($product['product_quantity']) : '';
        $product_description = isset($product['product_description']) ? trim($product['product_description']) : '';
        $product_type = isset($product['product_type']) ? trim($product['product_type']) : '';
        $product_image = isset($product['product_image']) ? trim($product['product_image']) : '';
        $seller_id = isset($product['seller_id']) ? trim($product['seller_id']) : '';
    
    
        if(empty($product_name) || empty($product_price) || empty($product_description) || empty($product_type) || empty($product_image))
        {
            $response = [
                'success' => false,
                'message' => 'Fields empty',
            ];
            die();
        } else{

            // fetch the seller assosiated with a particular product
            $fetchSeller = $conn->prepare("SELECT seller_fname, seller_lname, seller_email, seller_contact FROM seller WHERE seller_id = ? ");
            $fetchSeller->bind_param("i", $seller_id);
            $fetchSeller->execute();
            $sellerData = $fetchSeller->get_result();

            //inserting data into the database (in robots voice)
            $stmt = $conn->prepare("INSERT INTO product (product_name, product_description, product_type, product_quantity, product_price, product_image, seller_id) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssidsi", $product_name, $product_description, $product_type, $product_quantity, $product_price, $product_image, $seller_id);
            if ($stmt->execute()) {
                $response = [
                    'success' => true, 
                    'message' => 'Product created successfully',
                    'sellerData' => $sellerData->fetch_assoc()
                ];
            } else {
               $response = ['success' => false , 'message' => 'Error: ' . $stmt->error];
            }
            $stmt->close();
    
        }
        echo json_encode($response);
    }
        $conn->close();
?>