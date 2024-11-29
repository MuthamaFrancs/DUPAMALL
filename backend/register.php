<?php
header('Content-Type: aplication/json');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Access-Control-Allow-Origin, Accept");
require 'connect_db.php';


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

        $response = [
            'code' => 0,
            'message' => 'Empty Fields'
        ];
        echo  json_encode($response);
        die('All fields are required');

    } else if($password !== $confirmpassword){
        $response = [
            'code'=> 1,
            'message' => 'Password do not match'
        ];
        
    } else {

        // check whether such a user exists
        $existuser  = $conn->prepare("SELECT * FROM seller WHERE seller_email = ?");
        $existuser->bind_param("s", $email);
        $existuser->execute();
        $result = $existuser->get_result();

        if($result->num_rows > 0) {
            $response = [
                'code' => 0,
                'message' => 'User already exists'
            ];

            echo json_encode($response);
        } else {

        $encrypt_password = password_hash($password,PASSWORD_DEFAULT, );
        //inserting data into the database and preventing sqlinjections idk who would try injecting a class project :laughs
        $stmt = $conn->prepare("INSERT INTO seller (seller_fname, seller_lname, seller_email, seller_contact, seller_password) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $firstname, $lastname, $email, $phone, $encrypt_password);

        if ($stmt->execute()) {
            $response = [
                'code' => 1, 
                'message' => 'User created successfully'];
            
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    }
}
}

echo json_encode($response);
$conn->close();

?>
