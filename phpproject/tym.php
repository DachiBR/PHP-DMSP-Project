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

// Retrieve quiz results from the database
$stmt = $pdo->prepare('SELECT * FROM quiz_results ORDER BY date_time DESC');
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Retrieve high scores from the database
$stmt = $pdo->prepare('SELECT * FROM high_scores ORDER BY score DESC LIMIT 10');
$stmt->execute();
$highScores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html>
<head>
    <title>Quiz Results</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <style>
        body {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Quiz Results</h1>

        <h2>Latest Results:</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Score</th>
                    <th>Date/Time</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($results as $result): ?>
                    <tr>
                        <td><?php echo $result['user_name']; ?></td>
                        <td><?php echo $result['score']; ?></td>
                        <td><?php echo $result['date_time']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <h2>High Scores:</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Score</th>
                    <th>Date/Time</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($highScores as $score): ?>
                    <tr>
                        <td><?php echo $score['user_name']; ?></td>
                        <td><?php echo $score['score']; ?></td>
                        <td><?php echo $score['date_time']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
