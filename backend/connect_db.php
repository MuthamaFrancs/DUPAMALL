<?php

/** 
 * credentials needed for a database connection 
 * host => hostname
 * user => user logging into the database
 * pass => left as blank
 * db => the database for this project
 * 
 */
$host = 'localhost';
$user = 'classcom_DUPAMALL';
$pass = 'vB2QzvJLuyUqT8ej3Usu';
$db = 'classcom_DUPAMALL';

// creates connection to the database
$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die('Could not connect to MySQL: ' . mysqli_connect_error());
}


// This line caused confusion between text/html and application/json (Tendwa)
//echo 'Connected Successfully';

?>