<?php
// Establish database connection
$host = 'localhost';
$dbname = 'DMSP';
$username = 'root';
$db_password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}

// Process quiz submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and sanitize user inputs
    $userName = $_POST['user_name'];
    $score = $_POST['score'];

    // Save quiz results to the database
    $stmt = $pdo->prepare('INSERT INTO quiz_results (user_name, score) VALUES (:user_name, :score)');
    $stmt->bindParam(':user_name', $userName);
    $stmt->bindParam(':score', $score);
    $stmt->execute();

    // Check if the score is a high score and save it
    $stmt = $pdo->prepare('SELECT COUNT(*) FROM high_scores WHERE score < :score');
    $stmt->bindParam(':score', $score);
    $stmt->execute();
    $isHighScore = ($stmt->fetchColumn() === '0');

    if ($isHighScore) {
        $stmt = $pdo->prepare('INSERT INTO high_scores (user_name, score) VALUES (:user_name, :score)');
        $stmt->bindParam(':user_name', $userName);
        $stmt->bindParam(':score', $score);
        $stmt->execute();
    }

    // Redirect to the results page
    header('Location: tym.php');
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="home.css">
    <title>Programming Quiz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }
    </style>
</head>
<body>

<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
        <div class="col-md-3 mb-2 mb-md-0">
            <a href="./Home.html" class="d-inline-flex link-body-emphasis text-decoration-none">
                <input class="logosize" type="image" id="myimage" src="./pngs/logo.png" >
            </a>
        </div>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="./home.php" class="nav-link px-2 link-secondary">Home</a></li>
            <li><a href="./profile.php" class="nav-link px-2">Profile</a></li>
            <li><a href="./blog.php" class="nav-link px-2">Blog</a></li>
            <li><a href="./roadmaps.php" class="nav-link px-2">Roadmaps</a></li>
            <li><a href="./resources.php" class="nav-link px-2">Resources</a></li>
            <li><a href="./quiz.php" class="nav-link px-2">Quiz<a></li>
            <li><a href="./tym.php" class="nav-link px-2">TYM<a></li>
        </ul>

        <div class="col-md-3 text-end">
            <a href="./index.php"><button type="button" class="btn btn-outline-primary me-2">Login | Register</button></a>
        </div>
    </header>
</div>

    <div class="container">
        <h1>Programming Quiz</h1>

        <form method="post" action="">
            <div class="form-group">
                <label for="user_name">Your Name:</label>
                <input type="text" id="user_name" name="user_name" class="form-control" required>
            </div>

            <!-- Quiz questions and answer choices -->
            <div class="form-group">
                <h2>Question 1:</h2>
                <p>What is the output of the following Python code snippet?

                    <br>
                    <br>
                    numbers = [1, 2, 3, 4, 5]
                    <br>
                    squared_numbers = [x ** 2 for x in numbers if x % 2 == 0]
                    <br>
                    print(squared_numbers)
                </p>
                <div class="form-check">
                    <input type="radio" name="q1" value="a" class="form-check-input">
                    <label class="form-check-label">a) [4, 16]</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="q1" value="b" class="form-check-input">
                    <label class="form-check-label">b) [16, 4]</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="q1" value="c" class="form-check-input">
                    <label class="form-check-label">c) [1, 4, 9, 25]</label>
                </div>
            </div>

            <div class="form-group">
                <h2>Question 2:</h2>
                <p>Which of the following data structures in Python is mutable?</p>
                <div class="form-check">
                    <input type="radio" name="q2" value="a" class="form-check-input">
                    <label class="form-check-label">a) Tuples</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="q2" value="b" class="form-check-input">
                    <label class="form-check-label">b)  Lists</label>
                </div>
                <div class="form-check">
                    <input type="radio" name="q2" value="c" class="form-check-input">
                    <label class="form-check-label">c) Strings</label>
                </div>
            </div>

            <!-- Additional quiz questions -->

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="container">
    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
            <a href="/" class="mb-3 me-2 mb-md-0 text-body-secondary text-decoration-none lh-1">
                <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
            </a>
            <span class="mb-3 mb-md-0 text-body-secondary">© 2023 Company, Inc</span>
        </div>

        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
            <li class="ms-3"><a class="text-body-secondary" href="https://www.linkedin.com/in/bregadze28/"><input class="pngsize" type="image" id="myimage1" src="./pngs/linktst.png"></a></li>
            <li class="ms-3"><a class="text-body-secondary" href="https://www.instagram.com/bregadze28/"><input class="pngsize" type="image" id="myimage2" src="./pngs/instagrampng1.png"></a></li>
            <li class="ms-3"><a class="text-body-secondary" href="https://www.facebook.com/dachi.bregadze78/"><input class="pngsize" type="image" id="myimage3" src="./pngs/facebookTST.png"></a></li>
        </ul>
    </footer>
</div>
</body>
</html>
