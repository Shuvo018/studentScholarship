<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Document</title>
</head>

<body>
    <?php
    include 'adminNav.php';

    ?>
    <h1>Add Mentor </h1>
    <div class="container mt-5" style="width: 60vw; min-width: 300px">
        <form action="addMentor.php" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
                <div class="col">
                    <label for="">Name</label>
                    <input type="text" class="form-control" name="name" placeholder="">
                </div>
                <div class="col">
                    <label for="">level of study</label>
                    <input type="text" class="form-control" name="level_of_study" placeholder="">
                </div>
                <div class="col">
                    <label for="">University</label>
                    <input type="text" class="form-control" name="university" placeholder="">
                </div>
                <div class="col">
                    <label for="">Subject</label>
                    <input type="text" class="form-control" name="subject" placeholder="">
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
                        <optioSn value="New_Zealand">New Zealand</optioSn>
                        <option value="France">France</option>
                        <option value="Germany">Germany</option>
                        <option value="Italy">Italy</option>
                        <option value="Netherlands">Netherlands</option>
                        <option value="Spain">Spain</option>
                        <option value="UK">UK</option>
                    </select>
                </div>
                <div class="col">
                    <label for="">current work</label>
                    <input type="text" class="form-control" name="current_work" placeholder="">
                </div>
                <div class="col">
                    <label for="">Image</label>
                    <input type="file" name="image" accept="image/*">
                </div>
            </div>
            <div class="form-btn mt-3">
                <input type="submit" class="btn btn-primary" value="add" name="submit">
            </div>
        </form>
    </div>
    <!-- Bootstrap 5  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>

</html>
<?php
if (isset($_POST["submit"])) {
    $name = $_POST['name'];
    $level_of_study = $_POST['level_of_study'];
    $subject = $_POST['subject'];
    $Selected_country = $_POST['Selected_country'];
    $current_work = $_POST['current_work'];
    $university = $_POST['university'];
    $image = '';



    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $image = $_FILES['image']['tmp_name'];
        $imgContent = file_get_contents($image);
    } else {
        echo "Please upload image";
    }

    if ($university == "" || $image == "" || $level_of_study == "" || $name == "" || $subject == "" || $Selected_country == "" || $current_work == "") {
        echo "Please fill all the fields";
    } else {
        require_once "../db.php";
        $db = new DBController();
        $conn = new mysqli("localhost", "root", "", "studentscholarship");

        $sql = "INSERT INTO `mentor`(`image`, `name`, `study`, `university`, `subject`, `country`, `current_work`)
         VALUES(?,?,?,?,?,?,?)";
        $statement = $conn->prepare($sql);
        $statement->bind_param('sssssss', $imgContent, $name, $level_of_study, $university, $subject, $Selected_country, $current_work);
        $current_id = $statement->execute() or die("<b>Error:</b> Problem on Insert<br/>" . mysqli_connect_error());
        if ($current_id) {
            echo "University added successfully";
        } else {
            echo "Error";
        }
    }
}

?>