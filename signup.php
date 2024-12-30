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
    <!-- Navigation -->
    <?php
    include('nav.php')
    ?>

    <?php
    if (isset($_POST["submit"])) {
        $firstname = $_POST["fname"];
        $lastname = $_POST["lname"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        $country = $_POST['Selected_country'];
        $studyLevel = $_POST['Scholarship_for'];

        $errors = array();
        if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
            array_push($errors, "All fields are required");
        }
        if (!ctype_alpha($firstname)) {
            array_push($errors, "First name must contain only alphabetic characters");
        }

        if (!ctype_alpha($lastname)) {
            array_push($errors, "Last name must contain only alphabetic characters");
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
        }
        if (strlen($password) < 4) {
            array_push($errors, "Password must be at least 5 characters long");
        }
        $sql = "SELECT * FROM student WHERE email = '$email'";
        $result = $db->readData($sql);
        if (!empty($result)) {
            array_push($errors, "Email already exist !");
        }
        if (count($errors) > 0) {
            foreach ($errors as $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
        } else {

            $sql = "INSERT INTO student(first_name, last_name, email, password)
         VALUES ('$firstname', '$lastname', '$email', '$password')";
            $userId = $db->insertData($sql);
            if ($userId > 0) {
                $sql = "INSERT INTO `studentdetails`(`levelOfStudy`, `country`, `stuId`) VALUES ('$studyLevel','$country','$userId')";
                $idontneedit = $db->insertData($sql);
                if ($idontneedit > 0) {
                    $_SESSION["user"] = true;
                    $_SESSION["user_id"] = $userId;
                    echo "<div class='alert alert-success'> You are registered sucessfully.</div>";
                    header("Location: index.php");
                    exit();
                }
            } else {
                die("Something went wrong");
            }
        }
    }
    ?>
    <div class="container mt-5" style="width: 60vw; min-width: 300px">
        <form action="signup.php" method="post">
            <div class="row mb-3">
                <div class="col">
                    <label for="">First name :</label>
                    <input type="text" class="form-control" name="fname" placeholder="First Name:">
                </div>
                <div class="col">
                    <label for="">Last name :</label>
                    <input type="text" class="form-control" name="lname" placeholder="Last Name:">
                </div>
            </div>
            <div class="form-group mb-3">
                <label for="">Email :</label>
                <input type="emamil" class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="form-group">
                <label for="">Password : <small>Password must be at least 5 characters long</small></label>
                <input type="password" class="form-control" name="password" placeholder="Password:">
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="form-label">Scholarship for</label>
                    <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="Scholarship_for">
                        <option value="undergraduate" selected>undergraduate</option>
                        <option value="Masters">Masters</option>
                        <option value="Doctoral">Doctoral</option>
                        <option value="PhD">PhD</option>
                    </select>
                </div>
                <div class="col">
                    <label for="form-label">Select country</label>
                    <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="Selected_country">
                        <option value="USA" selected>USA</option>
                        <option value="Japan">Japan</option>
                        <option value="Canada">Canada</option>
                        <option value="South_Africa">South Africa</option>
                        <option value="China">China</option>
                        <option value="Thailand">Thailand</option>
                        <option value="Austraila">Austraila</option>
                        <option value="New_Zealand">New Zealand</option>
                        <option value="France">France</option>
                        <option value="Germany">Germany</option>
                        <option value="Italy">Italy</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Spain">Spain</option>
                        <option value="UK">UK</option>
                    </select>
                </div>
            </div>
            <div class="form-btn mt-3">
                <input type="submit" class="btn btn-primary" value="Register" name="submit">
            </div>
        </form>
        <div>
            <div>
                <p>Already Registered <a href="login.php">Login Here</a></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
</body>

</html>