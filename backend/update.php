<?php
header('Content-Type: aplication/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Accept");

// importing file for connecting to database
require 'connect_db.php';

if($conn->connect_error){
    json_encode([
        'success' => false,
    'message' => 'Connection failed with :'.$conn->connect_error]);
    die();
}

if($_SERVER['REQUEST_METHOD'] === 'PUT'){

    //decoding the json data sent to the server
       $reponse = [];
       $uri = $_SERVER['REQUEST_URI'];
       $body = file_get_contents('php://input');
        // 1. Fetch the uri string containing the parameters for a product update
        $enduri = explode("/", trim(parse_url($uri, PHP_URL_PATH)));
        $productId = isset($enduri[count($enduri) - 1]) ? (int)$enduri[count($enduri) - 1] : 0;

        // extract the details of the product from a http request body
        $productDetails = json_decode($body, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode([
                'success' => false,
                'message' => 'Error in parsing json'
            ]);
            die();
        }
        if ($productId === 0) {
            $reponse = [
                'success' => false,
                'message' => 'Invalid product id',
            ];
            echo json_encode($response);
            die();
        } else {
            // update  the database according to details provided
            $updateFields = [];
            $updateValues = [];
            $paramTypes = '';
    
            // iterate through the product details passed via params and store them in an array with their values
            foreach ($productDetails as $key => $value) {
                $updateFields[] = "$key = ?";
                $updateValues[] = $value;
                $paramTypes .= is_int($value) ? 'i' : 's';
            }
    
            if (empty($updateFields)) {
                echo json_encode(
                   [ 'success' => false,
                    'message' => 'No valid update data provided',
                ]);
                die();
            }
            $query = "UPDATE product SET " . implode (", ", $updateFields) . " WHERE product_id = ?";
            $stmt = $conn->prepare($query);

            if(!$stmt) {
                echo json_encode([
                    'success' => false,
                    'message' => 'SQL error: ' . $conn->error
                ]);
                die();
            }

            $paramTypes .= 'i';
            $updateValues[] = $productId;
    
            // bind parameters dybamically
            // the first s is for the string details except the last value which is the productId
            $stmt->bind_param($paramTypes, ...$updateValues);
    
            if($stmt->execute()){
                $response = [
                    'success' => true,
                    'message' => 'Product updated successfully'
                ];
            } else {
                $response = [
                    'success' => false,
                    'message' => 'Failed to update product. ' . $stmt->error,
                ];
            }
            echo json_encode($response);
            $stmt->close();
            $conn->close();
        }
    } else {
        $response = [
            'success' => false,
            'message' => 'Error in http request method'
        ];
        echo json_encode($response);
        die();
    }

    
?>