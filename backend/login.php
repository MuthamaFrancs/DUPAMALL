<?php
header('Content-Type: aplication/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Accept");
// importing file for connecting to database
require_once 'connect_db.php';
// fetches the data we use to login

$contact = $_GET['contact'];
$password = $_GET['password'];

if(!$contact || !$password){
    echo json_encode(['code' => 0, 'message' => 'Contact and password required']);
    exit;
}
// Query to fetch user records based on phone and password
$query = $conn->prepare("SELECT * FROM seller WHERE seller_contact = ?");
$query->bind_param("s", $contact, );
$query->execute();
$result = $query->get_result();

// if the number of rows is greater than 1, then we do have a user present
if ($result->num_rows > 0) {
 // Fetch user details
 $user = $result->fetch_assoc();
 


 // check whether the user has the same password as the one
 if (password_verify($password,$user['seller_password'])) {
    echo json_encode([
        'code' => 1,
        'message' => 'Login successful.',
        'userdetails' => $user
    ]);

 } else {
    echo json_encode([
        'code' => 0,
        'message' => "Invalid Password"]);
 }
 } else {
    echo json_encode([
        'code' => 0,
        'message' => 'User not found',
    ]);
 // Return error response if credentials are invalid
 }
$query->close();

mysqli_close($conn);
?>