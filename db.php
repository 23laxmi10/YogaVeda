<?php
$host = 'localhost';  // Host name
$dbname = 'yoga_website';  // Your database name
$username = 'root';  // Default XAMPP username
$password = '';  // Default XAMPP password (empty)

// Create a connection
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check if the connection is successful
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
