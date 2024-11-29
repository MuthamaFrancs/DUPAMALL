<?php
// importing file for connecting to database
require 'connect_db.php';

//checking if connection was successful
if($conn -> connect_error) {
    $error = 'Connection failed with :' . $conn -> connect_error;
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = [];
    $data = json_decode(file_get_contents('php://input'), true);
    $seller_id = trim($data['seller_id']);

    //I dont think this if is necesarry at this point a seller_id cannot be null
    if(empty($seller_id)) {
        $response = [
            'success' => false,
            'message' => 'Please Fields'
        ];
        die();
    } else {
        // check whether such a user exists
        $existuser = $conn -> prepare("SELECT * FROM seller WHERE seller_id = ?");
        $existuser -> bind_param("i", $seller_id);
        $existuser -> execute();
        $result = $existuser -> get_result();

        if($result -> num_rows > 0) {
            
            echo json_encode($response);
            $response = $conn -> prepare("DELETE FROM seller WHERE seller_id = ?");
            $response -> bind_param("i", $seller_id);
            $response -> execute();
            
            echo json_encode(
                $response = [
                'success' => true,
                'message' => 'User deleted successfully'
                ]);
                
        } else {
            $response = [
                'success' => false,
                'message' => 'User does not exist'
            ];
            echo json_encode($response);
        }
    }
        

}
?>