<?php
header('Content-Type: aplication/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Accept");
require "connect_db.php";

if($conn->connect_error){
    $error = 'Connection failed with :'.$conn->connect_error;
}

//read by name
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $data = json_decode(file_get_contents('php://input'), true);

    $product_name = trim($data['product_name']);

    if(empty($product_name))
    {
        $response = [
            'success' => false,
            'message' => 'Empty Fields'
        ];
        echo  json_encode($response);
        die('All fields are required');

    } else {

        // check whether such a user exists
        $existuser  = $conn->prepare("SELECT * FROM product WHERE product_name = ?");
        $existuser->bind_param("s", $product_name);
        $existuser->execute();
        $result = $existuser->get_result();

        if($result->num_rows > 0) {
            $response = [
                'success' => true,
                'message' => 'Product found',
                'data' => $result->fetch_assoc()
            ];

            echo json_encode($response);
        } else {
            $response = [
                'success' => false,
                'message' => 'Product not found'
            ];

            echo json_encode($response);
        }
    }
}

?>