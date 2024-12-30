<?php

?>
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
    // navigation
    include('nav.php');
    if (!isset($_SESSION["user"])) {
        header('Location: login.php');
    }
    ?>
    <!-- trash -->
    <?php
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT * FROM student WHERE id = $user_id";
    $user = $db->readData($sql);
    $sql = "SELECT `levelOfStudy`, `country` FROM `studentdetails` WHERE `stuId` = $user_id";
    $userDetails = $db->readData($sql);
    ?>
    <!-- trash -->
    <!-- Profile Section -->
    <!-- <img src="images/19835157_6182682.jpg" class="img-fluid" alt="..."> -->

    <div id="profile" class="container mt-4 section">
        <div class="row">
            <div class="col-md-6">
                <img src="images/19835157_6182682.jpg" class="img-fluid" alt="...">
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header custom-bg">
                        Student Profile
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="form-label">First name</label>
                            <input type="text" class="form-control mb-1" value="<?php echo $user[0]['first_name']; ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Last Name</label>
                            <input type="text" class="form-control" value="<?php echo $user[0]['last_name']; ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">E-mail</label>
                            <input type="text" class="form-control mb-1" value="<?php echo $user[0]['email']; ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">level of study</label>
                            <input type="text" class="form-control mb-1" value="<?php echo $userDetails[0]['levelOfStudy']; ?>">
                        </div>
                        <div class="form-group">
                            <label class="form-label">country</label>
                            <input type="text" class="form-control mb-1" value="<?php echo $userDetails[0]['country']; ?>">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h2 class="mt-5">Lives</h2>
        <?php
        $sql = "SELECT * FROM `enrolled_class` WHERE stu_id = $user_id";
        $enrollClasses = $db->readData($sql);
        if (!empty($enrollClasses)) {
        ?>
            <table class="table mt-5">
                <thead>
                    <tr>
                        <th scope="col">Mentor</th>
                        <th scope="col">live Date</th>
                        <th scope="col">live time</th>
                        <th scope="col">level of study</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($enrollClasses as $k => $v) {
                        $mentorLiveId = $enrollClasses[$k]['mentorLiveId'];
                        $sql = "SELECT * FROM `mentor_live` WHERE id = $mentorLiveId";
                        $mentorLive = $db->readData($sql);
                        $mentorId = $mentorLive[0]['mentorId'];
                        $sql = "SELECT * FROM `mentor` WHERE id = $mentorId";
                        $mentor = $db->readData($sql);
                    ?>
                        <tr>
                            <th scope="row"><?php echo $mentor[0]['name']; ?></th>
                            <td><?php echo $mentorLive[0]['live_Date']; ?></td>
                            <td><?php echo $mentorLive[0]['live_time']; ?></td>
                            <td><?php echo $mentor[0]['study']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        <?php
        }
        ?>
    </div>

    <?php
    $sql = "SELECT * FROM blog WHERE stu_id = $user_id";
    $blogs = $db->readData($sql);
    if (!empty($blogs)) {
    ?>
        <h1 style="text-align: center;">My blog</h1>
        <?php
        foreach ($blogs as $k => $v) {
        ?>
            <div class="container card w-75">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $blogs[$k]['title'] . " || " . $blogs[$k]['date'] ?></h5>
                    <p class="card-text">Writer : <?php echo $blogs[$k]['writer'] ?></p>
                    <p class="card-text"><span class="fs-4">Type : </span><?php echo $blogs[$k]['type'] ?></p>
                    <a href="blogDetails.php?blog_id=<?php echo $blogs[$k]['id'] ?>" class="btn btn-primary">see more</a>
                </div>
            </div>
    <?php
        }
    }
    ?>
    <!-- Bootstrap 5 -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>

</html>