<?php
require_once "db.php";
$db = new DBController();
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Scholarship Portal</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark custom-bg">
        <div class="container">
            <a class="navbar-brand" href="index.php">VentureHub</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="scholarships.php">Scholarships</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="blogs.php">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="mentor.php">mentor</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <?php
                        if (isset($_SESSION["user_id"])) {
                        ?>
                            <a class="nav-link" href="login.php">logout</a>
                        <?php
                        } else {
                        ?>
                            <a class="nav-link" href="login.php">login</a>

                        <?php
                        }
                        ?>

                    </li>
                </ul>
            </div>
        </div>
    </nav>
</body>

</html>