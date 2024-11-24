<?php
header('Content-Type: aplication/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Accept");

require_once 'connect_db.php';

//setting up db connection
//$conn = new mysqli('localhost','dupamall','dupamall','dupamall');

if($conn->connect_error){
    $error = 'Connection failed with :'.$conn->connect_error;
}


//form submission halding
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $firstname=trim($_POST['firstname']);
    $lastname=trim($_POST['lastname']);
    $email=trim($_POST['email']);
    $phone=trim($_POST['phone']);
    $password=trim($_POST['password']);
    $confirmpassword=trim($_POST['confirmpassword']);
    if(empty($firstname) || empty($lastname) || empty($email) || empty($phone) || empty($password) || empty($confirmpassword))
    {
        die('All fields are required');
    } elseif($password !== $confirmpassword){
        $error='Password do not match';
    } else{

        $encrypt_password = password_hash($password,PASSWORD_DEFAULT);
        //inserting data into the database and preventing sqlinjections idk who would try injecting a class project :laughs
        $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, phone, password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstname, $lastname, $email, $phone, $encrypt_password);

        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();

    }
}

$conn->close();

?>
