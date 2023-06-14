<?php
session_start();

// Check if the admin is already logged in
if (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    // Redirect to the protected page
    header("Location: together.php");
    exit();
}

// Check if the form is submitted for authentication
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate the submitted username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verify the admin credentials (you can modify this as per your needs)
    if ($username === 'admin' && $password === 'admin') {
        // Authentication successful, set the admin session
        $_SESSION['admin'] = true;

        // Redirect to the protected page
        header("Location: together.php");
        exit();
    } else {
        // Invalid credentials, display an error message
        $error = "Invalid username or password";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Admin Login</h1>
        <?php if (isset($error)) : ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>
