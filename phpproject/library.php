<?php
// Database connection configuration
$host = 'localhost';
$dbname = 'library';
$username = 'root';
$password = '';

// Create a new PDO instance
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

// Retrieve all books from the database
$stmt = $pdo->query("SELECT * FROM books");
$books = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="path/to/tailwind.css">
    <title>Library</title>
</head>
<body>
    <h1>Library</h1>

    <div class="grid grid-cols-2 gap-4">
        <?php foreach ($books as $book): ?>
        <div class="border p-4">
            <h2><?php echo $book['title']; ?></h2>
            <p>Author: <?php echo $book['author']; ?></p>
            <p><?php echo $book['description']; ?></p>
            <p>Published Date: <?php echo $book['published_date']; ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
