<?

/** 
 * credentials needed for a database connection 
 * host => hostname
 * user => user logging into the database
 * pass => left as blank
 * db => the database for this project
 * 
 */
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'dupa_mall';

// creates connection to the database
$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die('Could not connect to MySQL: ' . mysqli_connect_error());
}

echo 'Connected Successfully';

?>