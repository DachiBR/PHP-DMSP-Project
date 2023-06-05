<?php
// Check if the book ID is provided in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: admin.php");
    exit;
}

$bookId = $_GET['id'];

// Database connection configuration
$host = 'localhost';
$dbname = 'library';
$username = 'root';
$password = '';


// Create a new PDO instance
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

// Prepare the DELETE statement
$stmt = $pdo->prepare("DELETE FROM books WHERE id = ?");

// Execute the statement with the book ID to delete the book
$stmt->execute([$bookId]);

// Redirect to the admin panel
header("Location: admin.php");
exit;
