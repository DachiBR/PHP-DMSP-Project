<!DOCTYPE html>
<html>
<head>
  <title>Add Roadmap</title>
  <!-- Include Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
  <div class="container">
    <h1>Add Roadmap</h1>
    <form method="POST" action="">
      <div class="form-group">
        <label for="language">Roadmap Name:</label>
        <input type="text" class="form-control" id="language" name="language" required>
      </div>
      <div class="form-group">
        <label for="link">Roadmap Link:</label>
        <input type="text" class="form-control" id="link" name="link" required>
      </div>
      <div class="form-group">
        <label for="type">Type of Roadmap:</label>
        <input type="text" class="form-control" id="type" name="type" required>
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
  </div>

  <?php
  // Check if the form is submitted
  if (isset($_POST['submit'])) {
    // Retrieve form data
    $language = $_POST['language'];
    $link = $_POST['link'];
    $type = $_POST['type'];

    // Database connection configuration
    $host = 'localhost';
    $dbname = 'DMSP';
    $username = 'root';
    $db_password = '';

    // Create a database connection
    $conn = new mysqli($host, $username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to insert data into the database
    $sql = "INSERT INTO roadmaps (language, link, type) VALUES ('$language', '$link', '$type')";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
      echo '<div class="container mt-3"><div class="alert alert-success">Roadmap added successfully!</div></div>';
    } else {
      echo '<div class="container mt-3"><div class="alert alert-danger">Error: ' . $conn->error . '</div></div>';
    }

    // Close the database connection
    $conn->close();
  }
  ?>

  <!-- Include Bootstrap JS -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
