<?php

// importing file for connecting to database
require 'connect_db.php';

 if($conn->connect_error){
     $error = 'Connection failed with :'.$conn->connect_error;
 }

 //deleting is a post request
 if($_SERVER['REQUEST_METHOD'] === 'POST'){

    //decoding the json data sent to the server
     $product = json_decode(file_get_contents('php://input'), true);

     //for deleting we need the product id
     $product_id = trim($product['product_id']);
     
     //checking if the product id is empty
     if(empty($product_id)){
         die('Product ID is required to perfom a delete operation');
     } else{

        //deleting data from the database 
        $stmt = $conn->prepare("DELETE FROM product WHERE product_id = ?");
        $stmt->bind_param("s", $product_id);

        if ($stmt->execute()) {
            echo json_encode(['code' => 1, 'message' => 'Product deleted successfully']);
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();

    }
}
$conn->close();

?>