<?php

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the submitted form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // TODO: Perform validation and registration logic here
    // Perform additional validation and checks before storing the data

    // Validate name
    if (empty($name)) {
        echo 'Please enter your name.';
        exit;
    }

    // Validate email
    if (empty($email)) {
        echo 'Please enter your email.';
        exit;
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'Please enter a valid email address.';
        exit;
    }

    // Validate password
    if (empty($password)) {
        echo 'Please enter a password.';
        exit;
    } elseif (strlen($password) < 8) {
        echo 'Password must be at least 8 characters long.';
        exit;
    }

    // Database connection configuration
    $host = 'localhost';
    $dbname = 'DMSP';
    $username = 'root';
    $db_password = '';

    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $db_password);

    // Check if the email is already registered
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        echo 'Email address is already registered.';
        exit;
    }

    // Prepare the INSERT statement
    $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Execute the statement with the user data
    $stmt->execute([$name, $email, $hashedPassword]);

    // Check if the insertion was successful
    if ($stmt->rowCount() > 0) {
        // Registration successful
        echo 'Registration successful!';

        // Redirect to the login page with a login parameter
        header("Location: index.php?login");
        exit;
    } else {
        // Registration failed
        echo 'Registration failed. Please try again.';
    }
}

