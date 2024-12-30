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
    <h1>Add university </h1>
    <div class="container mt-5" style="width: 60vw; min-width: 300px">
        <form action="addUniversity.php" method="post" enctype="multipart/form-data">
            <div class="row mb-3">
                <div class="col">
                    <label for="">University name</label>
                    <input type="text" class="form-control" name="university_name" placeholder="">
                </div>
                <div class="col">
                    <label for="">website link</label>
                    <input type="text" class="form-control" name="weblink" placeholder="">
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
    $university_name = $_POST['university_name'];
    $weblink = $_POST['weblink'];
    $image = '';

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $image = $_FILES['image']['tmp_name'];
        $imgContent = file_get_contents($image);
    } else {
        echo "Please upload image";
    }

    if ($university_name == "" || $weblink == "" || $image == "") {
        echo "Please fill all the fields";
    } else {
        require_once "../db.php";
        $db = new DBController();
        $conn = new mysqli("localhost", "root", "", "studentscholarship");

        $sql = "INSERT INTO `university`(`name`, `websiteLink`, `image`)
         VALUES(?,?,?)";
        $statement = $conn->prepare($sql);
        $statement->bind_param('sss', $university_name, $weblink, $imgContent);
        $current_id = $statement->execute() or die("<b>Error:</b> Problem on Insert<br/>" . mysqli_connect_error());
        if ($current_id) {
            echo "University added successfully";
        } else {
            echo "Error";
        }
    }
}

?>