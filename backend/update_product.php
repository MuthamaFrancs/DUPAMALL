<?php
require 'connect_db.php';

// the request made is to update the value of a new product
// update the product quantity, price, description, or type
$product_name = $_GET["product"];

$flag['success'] = 0;
if($res = mysqli_query($conn,'UPDATE product SET '))

?>