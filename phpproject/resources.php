<?php
include 'config.php';

// Retrieve data from the database
$result = $conn->query("SELECT * FROM your_table");
$data = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Resources</title>
    <link rel="stylesheet" href="home.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        table {
            margin-top: 20px;
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
        <h2>Resources</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Programming Language</th>
                    <th>Useful Information</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $row): ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
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
