<?php
$host = 'localhost';
$dbname = 'DMSP';
$username = 'root';
$db_password = '';

// Create a connection
$conn = new mysqli($host, $username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
