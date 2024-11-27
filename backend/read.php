<?php
// importing file for connecting to database
require 'connect_db.php';

//checking if connection was successful
if($conn->connect_error){
    $error = 'Connection failed with :'.$conn->connect_error;
}
    // used php://input to read the json string
    $uri = $_SERVER['REQUEST_URI'];
    $uriParts =  explode("/", parse_url($uri, PHP_URL_PATH));
    $productId = (int)end($uriParts);

    // if productId is 0 then it returns all products 
    if ($productId === 0)
    {
        $query = $conn->prepare("SELECT * FROM product ORDER BY product_id DESC");

    $query->execute();
    $result = $query->get_result();
    $products = [];

    while($row = $result->fetch_assoc()){
        $products[] = $row;
    }

    echo json_encode($products);
    mysqli_close($conn);

    } else {

        // if the uri contains a product id, it returns the value for one product
      $query = $conn->prepare("SELECT * FROM product WHERE product_id = ?");
      $query->bind_param("i", $productId);
      $query->execute();
      $res = $query->get_result();
      if ($res->num_rows > 0) {
          $details = $res->fetch_assoc();
          $response = [
              'success' => true,
              'message' => 'Product Details',
              'data' => $details,
            ];
    } else {
        $response = [
            'success' => false,
            'message' => 'Product not found',
            'data' => []
        ];
    }
    echo json_encode($response);
    }
    mysqli_close($conn);

?>