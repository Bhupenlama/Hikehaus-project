<?php
// connection.php
$servername = "localhost";
$username = "root";  // replace with your MySQL username
$password = "";      // replace with your MySQL password
$dbname = "hike_haus"; // replace with your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
