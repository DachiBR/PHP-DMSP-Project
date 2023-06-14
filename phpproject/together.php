<?php
include 'config.php';

session_start();

// Check if the user is not logged in
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    // User is not logged in, redirect to the login page
    header("Location: admin.php");
    exit;
}


// Add data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add"])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    // Add other form fields here

    // Prepare and bind the statement
    $stmt = $conn->prepare("INSERT INTO your_table (name, email) VALUES (?, ?)");
    $stmt->bind_param("ss", $name, $email);
    // Bind other form fields here

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record added successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Delete data
if (isset($_GET["delete"])) {
    $id = $_GET['delete'];

    // Prepare and bind the statement
    $stmt = $conn->prepare("DELETE FROM your_table WHERE id = ?");
    $stmt->bind_param("i", $id);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Edit data
if (isset($_GET["edit"])) {
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * FROM your_table WHERE id = $id");
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $editName = $row['name'];
        $editEmail = $row['email'];
    } else {
        echo "No record found.";
    }
}

// Update data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    // Add other form fields here

    // Prepare and bind the statement
    $stmt = $conn->prepare("UPDATE your_table SET name = ?, email = ? WHERE id = ?");
    $stmt->bind_param("ssi", $name, $email, $id);
    // Bind other form fields here

    // Execute the statement
    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h2>Add Data</h2>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label for="name">Programming Language</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Description</label>
                <input type="text" class="form-control" id="email" name="email" required>
            </div>
            <!-- Add other form fields here -->
            <button type="submit" class="btn btn-primary" name="add">Add</button>
        </form>

        <hr>

        <h2>Delete Data</h2>
        <?php
        $result = $conn->query("SELECT * FROM your_table");
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<p>" . $row['name'] . " - " . $row['email'] . " <a href='?delete=" . $row['id'] . "'>Delete</a> <a href='?edit=" . $row['id'] . "'>Edit</a></p>";
            }
        } else {
            echo "No records found.";
        }
        ?>

        <hr>

        <h2>Edit Data</h2>
        <?php if (isset($_GET["edit"])) { ?>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $editName; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Description:</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?php echo $editEmail; ?>" required>
                </div>
                <!-- Add other form fields here -->
                <button type="submit" class="btn btn-primary" name="update">Update</button>
            </form>
        <?php } ?>
        <div class="logutbutton"><a href="logout.php"><p>Logout</p></a></div>
    </div>
</body>
</html>
