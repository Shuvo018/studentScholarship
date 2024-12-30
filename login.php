<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    include('nav.php');
    ?>
    <!-- Login/Signup Section -->
    <div id="login" class="container mt-4 section">
        <div class="container">
            <?php
            if (isset($_POST["login"])) {
                $email = $_POST["email"];
                $password = $_POST["password"];


                $sql = "SELECT * FROM student WHERE email = '$email'";
                $user = $db->readData($sql);
                if ($user) {
                    if ($password == $user[0]["password"]) {
                        $_SESSION["user"] = true;
                        $_SESSION["user_id"] = $user[0]['id'];
                        // echo $_SESSION["user_id"];
                        header("Location: index.php");
                        // die();
                    } else {
                        echo "<div class='alert alert-danger'>Password does not match </div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>Email does not match </div>";
                }
            }
            ?>

            <form action="login.php" method="post">
                <div class="form-group mb-3">
                    <label for="">Email: </label>
                    <input type="email" placeholder="Enter Email:" name="email" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="">Password: </label>
                    <input type="password" placeholder="Enter password:" name="password" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" name="login" value="login" class="btn btn-primary">
                </div>
            </form>
            <div>
                <p>Not registered yet <a href="signup.php">Registration here</a></p>
            </div>
        </div>
    </div>
    <!-- Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>