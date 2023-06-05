<?php
// Add book form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted form data
    $title = $_POST['title'];
    $author = $_POST['author'];
    $description = $_POST['description'];
    $published_date = $_POST['published_date'];

    // TODO: Perform validation on the form data

    // Database connection configuration
    $host = 'localhost';
    $dbname = 'library';
    $username = 'root';
    $password = '';

    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

    // Prepare the INSERT statement
    $stmt = $pdo->prepare("INSERT INTO books (title, author, description, published_date) VALUES (?, ?, ?, ?)");

    // Execute the statement with the book data
    $stmt->execute([$title, $author, $description, $published_date]);

    // Redirect to the admin panel
    header("Location: admin.php");
    exit;
}

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
    <title>Admin Panel</title>
</head>
<body>
    <h1>Admin Panel</h1>

    <!-- Add Book Form -->
    <h2>Add Book</h2>
    <form action="" method="post">
        <label for="title">Title</label>
        <input type="text" id="title" name="title" required>
        
        <label for="author">Author</label>
        <input type="text" id="author" name="author" required>
        
        <label for="description">Description</label>
        <textarea id="description" name="description" required></textarea>
        
        <label for="published_date">Published Date</label>
        <input type="date" id="published_date" name="published_date" required>
        
        <button type="submit">Add Book</button>
    </form>

    <!-- Book List -->
    <h2>Book List</h2>
    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Description</th>
                <th>Published Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($books as $book): ?>
            <tr>
                <td><?php echo $book['title']; ?></td>
                <td><?php echo $book['author']; ?></td>
                <td><?php echo $book['description']; ?></td>
                <td><?php echo $book['published_date']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $book['id']; ?>">Edit</a> |
                    <a href="delete.php?id=<?php echo $book['id']; ?>">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
