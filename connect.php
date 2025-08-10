<?php
// Step 1: Define connection variables
$servername = "localhost:3307";       // default for XAMPP
$username   = "root";            // default user for phpMyAdmin
$password   = "";                // default: no password in XAMPP
$dbname   = "food_app";     // ⬅️ replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

/*print_r($conn);
exit;*/
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
