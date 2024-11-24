<?php
require 'connect_db.php';

if($conn->connect_error){
    $error = 'Connection failed with :'.$conn->connect_error;
}

//form submission halding
if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $data = json_decode(file_get_contents('php://input'), true);

    $firstname = trim($data['firstname']);
    $lastname = trim($data['lastname']);
    $email = trim($data['email']);
    $phone = trim($data['phone']);
    $password = trim($data['password']);
    $confirmpassword = trim($data['confirmpassword']);
    
    if(empty($firstname) || empty($lastname) || empty($email) || empty($phone) || empty($password) || empty($confirmpassword))
    {
        die('All fields are required');
    } elseif($password !== $confirmpassword){
        $error='Password do not match';
    } else{

        $encrypt_password = password_hash($password,PASSWORD_DEFAULT);
        //inserting data into the database and preventing sqlinjections idk who would try injecting a class project :laughs
        $stmt = $conn->prepare("INSERT INTO seller (seller_fname, seller_lname, seller_email, seller_contact, seller_password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstname, $lastname, $email, $phone, $encrypt_password);

        if ($stmt->execute()) {
            echo json_encode(['code' => 1, 'message' => 'User created successfully']);
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();

    }
}

$conn->close();
?>
