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

// Check if the form is submitted for updating the book
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted form data
    $title = $_POST['title'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $published_date = $_POST['published_date'];

    // TODO: Perform validation on the form data

    // Prepare the UPDATE statement
    $stmt = $pdo->prepare("UPDATE books SET title = ?, author = ?, description = ?, published_date = ? WHERE id = ?");

    // Execute the statement with the updated book data
    $stmt->execute([$title, $author, $description, $published_date, $bookId]);

    // Redirect to the admin panel
    header("Location: admin.php");
    exit;
}

// Retrieve the book details from the database
$stmt = $pdo->prepare("SELECT * FROM books WHERE id = ?");
$stmt->execute([$bookId]);
$book = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if the book exists
if (!$book) {
    header("Location: admin.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="path/to/tailwind.css">
    <title>Edit Book</title>
</head>
<body>
    <h1>Edit Book</h1>

    <form action="" method="post">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" value="<?php echo $book['title']; ?>" required>
        
        <label for="author">Author</label>
        <input type="text" id="author" name="author" value="<?php echo $book['author']; ?>" required>
        
        <label for="description">Description</label>
        <textarea id="description" name="description" required><?php echo $book['description']; ?></textarea>
        
        <label for="published_date">Published Date</label>
        <input type="date" id="published_date" name="published_date" value="<?php echo $book['published_date']; ?>" required>
        
        <button type="submit">Update Book</button>
    </form>
</body>
</html>
