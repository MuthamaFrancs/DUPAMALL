<?php
header('Content-Type: aplication/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Accept");
// importing file for connecting to database
require_once 'connect_db.php';
// fetches the data we use to login


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = json_decode(file_get_contents('php://input'), true);

    $email = isset($user['email']) ? trim($user['email']) : '' ;
    $password = isset($user['password']) ? trim($user['password']) : '' ;
}

if(empty($email) || empty($password)){
    $response = [
        'code' => 0, 
        'message' => 'Empty fields'];
    echo json_encode($response);
    exit;
}
// Query to fetch user records based on phone and password
$query = $conn->prepare("SELECT * FROM seller WHERE seller_email = ?");
$query->bind_param("s", $email);
$query->execute();
$result = $query->get_result();

// if the number of rows is greater than 1, then we do have a user present
if ($result->num_rows === 1) {

 // Fetch user details
 $user = $result->fetch_assoc();

 // check whether the user has the same password as the one stored
 if (password_verify($password,$user['seller_password'])) {
    $response = [
        'code' => 1,
        'message' => 'Password correct',
        'userdetails' => $user
    ];

 } else {
    $response = [
        'code' => 0,
        'message' => "Invalid Password"];
 }
 } else {
    $response = [
        'code' => 0,
        'message' => 'User not found',
    ];
 // Return error response if credentials are invalid
 }

 echo json_encode((object)$response);
$query->close();
mysqli_close($conn);

?>