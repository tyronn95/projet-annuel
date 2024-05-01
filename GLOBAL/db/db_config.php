<?php
// Database configuration settings
$host = 'localhost';
$dbUser = 'root';
$dbPassword = 'root';
$dbName = 'pcs';

// Create a new MySQLi connection
$conn = new mysqli($host, $dbUser, $dbPassword, $dbName);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
