<?php
require 'connect_db.php';

/**
 * query to create new products
 */

 $pname = $_GET['pname'];
 $pdescription = $_GET['pdescription'];
 $ptype = $_GET['ptype'];
 $pquantity = intval($_GET['pquantity']);
 $price = floatval($_GET['price']);
 

 // **Crucial Change: Check for empty strings after filtering**
 if (empty($pname) || empty($pdescription) || empty($ptype) || $pquantity === false || $price === false) {
    die("Invalid or missing input data.  All fields are required.");
}

 if ($pname === false || $pdescription === false || $ptype === false || $pquantity === false || $price === false ) {
    die("Invalid input data.");
  }

$flag['success'] = 0;


// insert statement
 $insert_sql = "INSERT INTO product (product_id, product_name, product_description, product_type, product_quantity, product_price) 
 VALUES ('', ?, ?, ?, ?, ?)";


 $query = $conn->prepare($insert_sql);
// generate an error in the case the query fails to run
 if($query === false){
    die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
 }

 // Bind parameters (using appropriate data types)
if (!$query->bind_param("sssid", $pname, $pdescription, $ptype, $pquantity, $price)) { 
    //Adjust "sss" based on your field data types (string, integer, etc).
    die("Binding parameters failed: (" . $query->errno . ") " . $query->error);
}

if (!$query->execute()){
    die("Execute failed: (" . $query->errno . ")" . $query->error);
}
 echo "record created successfully";

 $query->close();
 $conn->close();

?>