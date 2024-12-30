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
    <!-- Navigation -->
    <?php
    include('adminNav.php')
    ?>

    <h2>Add BLOG</h2>
    <!-- Login/Signup Section -->
    <div id="login" class="container mt-4 section">
        <div class="container">
            <form action="addBlogAdmin.php" method="post">
                <div class="form-group mb-3">
                    <label for="">title: </label>
                    <input type="text" placeholder="title" name="title" class="form-control">
                </div>
                <div class="form-group mb-3">
                    <label for="">Description: </label>
                    <textarea name="description" id=""></textarea>
                </div>
                <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="blog_type">
                    <option value="tips" selected>tips</option>
                    <option value="suggestion">suggestion</option>
                    <option value="success_story">success story</option>
                </select>
                <div class="form-group">
                    <input type="submit" name="add" value="add" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap 5  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- <script src="app.js"></script> -->
</body>

</html>
<?php
if (isset($_POST["add"])) {
    $title = $_POST["title"];
    $description =  $_POST["description"];
    $blog_type = $_POST["blog_type"];

    // user details
    $user_id = 14;
    $user_name = "Admin";
    if (!empty($title) && !empty($description)) {
        require_once "../db.php";
        $db = new DBController();
        $sql4 = "INSERT INTO `blog`(`title`, `description`, `writer`, `type`, `stu_id`) VALUES ('$title','$description','$user_name','$blog_type',$user_id)";
        $user = $db->insertData($sql4);
        if ($user) {
            echo "<div class='alert alert-success'>successfully added </div>";
        } else {
            echo "<div class='alert alert-danger'>failed </div>";
        }
    }
}
?>