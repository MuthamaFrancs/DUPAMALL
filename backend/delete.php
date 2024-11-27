<?php

// importing file for connecting to database
require 'connect_db.php';

 if($conn->connect_error){
     $error = 'Connection failed with :'.$conn->connect_error;
 }

 //deleting is a post request
 if($_SERVER['REQUEST_METHOD'] === 'DELETE'){

    //decoding the json data sent to the server
    $uri = $_SERVER['REQUEST_URI'];
    $enduri = explode("/", trim(parse_url($uri, PHP_URL_PATH)));
    $productId = isset($enduri[count($enduri) - 1]) ? (int)$enduri[count($enduri) - 1] : 0;
    
     //checking if the product id is empty
     if(empty($product_id)){
        echo json_encode([
            'success' => true,
            'message' => 'Product ID required for deletion'
        ]);
        die();
     } else{

        //deleting data from the database 
        $stmt = $conn->prepare("DELETE FROM product WHERE product_id = ?");
        $stmt->bind_param("i", $product_id);

        if ($stmt->execute()) {
            echo json_encode(
                ['success' => true, 
                'message' => 'Product deleted successfully']);
        } else {
            echo json_encode(
                [
                    'success' => false,
                    'message' => 'Error: '. $stmt->error
                ]
                );
        }
        $stmt->close();

    }
}
$conn->close();

?>