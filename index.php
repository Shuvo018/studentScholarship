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
    <!-- php -->
    <?php

    ?>
    <!-- php -->
    <div class="image-container">
        <div class="text-overlay">
            <h1 class="display-4 mb-4">Find Your Perfect Scholarship</h1>
            <p class="lead">Discover opportunities that can help fund your education.</p>
        </div>
        <img src="images/freepik__retouch__73417.png" class="img-fluid" style="height: 80%;" alt="...">
    </div>
    <!-- Main Content Sections -->

    <div class="container my-5">


        <?php
        if (isset($_SESSION["user_id"])) {

            $user_id = $_SESSION["user_id"];
            $sql = "SELECT * FROM student WHERE id = $user_id";
            $user = $db->readData($sql);
            $sql = "SELECT `levelOfStudy`, `country` FROM `studentdetails` WHERE `stuId` = $user_id";
            $userDetails = $db->readData($sql);

            $levelOfStu = $userDetails[0]['levelOfStudy'];
            $country = $userDetails[0]['country'];
            $sql = "SELECT * FROM scholarship WHERE `levelOfStudy` = '$levelOfStu' and `country` = '$country'";

            $rows = $db->readData($sql);
            if (!empty($rows)) {
        ?>
                <h2>Recommend</h2>
                <div class="row">
                    <?php
                    foreach ($rows as $k => $v) {
                        $id = $rows[$k]['id'];
                        // get university information
                        $uni_id = $rows[$k]['universityId'];
                        $sql2 = "SELECT image FROM university WHERE id = $uni_id";
                        $rows2 = $db->readData($sql2);
                        if (!empty($rows2)) {
                            $uni_image = $rows2[0]['image'];
                    ?>

                            <div class="col-md-4 mb-4">
                                <div class="card border-success">
                                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($uni_image); ?>" class="card-img-top" style="width: 100%; height:200px;" alt="...">
                                    <div class="card-body  text-success">
                                        <h5 class="card-title"><?php echo $rows[$k]['title'] . " || " . $rows[$k]['country'] ?></h5>
                                        <a href="scholarshipDetails.php?scholarship_id=<?php echo $rows[$k]['id'] ?>" class="btn btn-success">see more</a>
                                    </div>
                                </div>
                            </div>
            <?php
                        }
                    }
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