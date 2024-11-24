<?php
require 'connect_db.php';

$flag['success'] = 0;
$flag['data']= array();

if ($products_query = mysqli_query($conn, "SELECT * FROM product")){
    $flag['success'] = 1;

    while($row = mysqli_fetch_assoc($products_query)) {
        $flag['data'][] = $row; 
    }
} else {
 $flag['success'] = 0;
 $flag['error'] = 'Query failed: '. mysqli_error($conn);
}

print(json_encode($flag));
mysqli_close($conn);
?>
