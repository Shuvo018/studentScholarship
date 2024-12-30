<?php

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
    <!-- Navigation -->
    <?php
    include('nav.php');
    if (!isset($_SESSION["user"])) {
        header('Location: login.php');
    }
    ?>
    <h2 class="text-center">BLOGS</h2>


    <div class="container my-5">
        <form action="blogs.php" method="post" class="d-flex flex-column align-items-center">
            <label for="">select blog type</label>
            <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="blog_type">
                <option value="all" selected>All</option>
                <option value="tips">tips</option>
                <option value="suggestion">suggestion</option>
                <option value="success_story">success story</option>
            </select>
            <input type="submit" value="search" class="btn btn-primary center" name="search">
        </form>

        <div class="mb-5">
            <a href="addBlog.php" class="btn btn-primary m-8">Add blog</a>
        </div>

        <div class="row">
            <?php

            if (isset($_POST["search"]) && $_POST["blog_type"] == "all") {
                $sql = "SELECT * FROM blog";
            } else if (isset($_POST["search"])) {
                $blog_type = $_POST["blog_type"];
                $sql = "SELECT * FROM blog WHERE type = '$blog_type'";
            } else {
                $sql = "SELECT * FROM blog";
            }

            $rows = $db->readData($sql);
            if (!empty($rows)) {
                foreach ($rows as $k => $v) {
                    $id = $rows[$k]['id'];
            ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $rows[$k]['title'] . " || " . $rows[$k]['date'] ?></h5>
                                <p class="card-text">Writer : <?php echo $rows[$k]['writer'] ?></p>
                                <p class="card-text"><span class="fs-5" id="highlight">Type : </span><?php echo $rows[$k]['type'] ?></p>
                                <a href="blogDetails.php?blog_id=<?php echo $rows[$k]['id'] ?>" class="btn btn-primary">see more</a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>


    <!-- Bootstrap 5  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- <script src="app.js"></script> -->
</body>

</html>