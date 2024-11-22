<?php
header('Content-Type: aplication/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Accept");
// importing file for connecting to database
require_once 'connect_db.php';
// fetches the data we use to login

$contact = $_GET['contact'];
$password = $_GET['password'];
// Query to fetch user records based on phone and password
$query = $conn->prepare("SELECT seller_contact, seller_password FROM seller WHERE seller_contact = ? AND seller_password = ?");
$query->bind_param("ss", $contact, $password);
$query->execute();
$result = $query->get_result();

// if the number of rows is greater than 1, then we do have a user present
if ($result->num_rows > 0) {
 // Fetch user details
 $rows = [];
 while ($row = $result->fetch_assoc()) {
 $rows[] = $row;
 }
 // Return success response with user details
 echo json_encode([
 'code' => 1,
 'userdetails' => $rows
 ]);
} else {
 // Return error response if credentials are invalid
 echo json_encode([
 'code' => 0,
 'message' => 'Invalid contact or password.'
 ]);
}
$query->close();
mysqli_close($conn);
?>