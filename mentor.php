<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- Navigation -->
    <?php
    include('nav.php');
    if (!isset($_SESSION["user"])) {
        header('Location: login.php');
    }
    // enroll student to mentor live class
    if (isset($_GET['mentor_live_id'])) {
        $getMentorLiveId = $_GET['mentor_live_id'];;
        $stuId = $_SESSION["user_id"];

        $sql = "INSERT INTO `enrolled_class`(`mentorLiveId`, `stu_id`) VALUES ($getMentorLiveId,$stuId)";
        $tokenID = $db->insertData($sql);
    }

    ?>
    <div class="container">
        <h1 style="text-align: center; margin: 5px">All mentors</h1>

        <div class="row">
            <?php
            $mentor = $db->readData("SELECT * FROM mentor");

            if (!empty($mentor)) {
                foreach ($mentor as $k => $v) {
                    $id = $mentor[$k]['id'];
                    // get university information
            ?>

                    <div class="col-md-4 m-4">
                        <div class="card border-success">
                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($mentor[$k]['image']); ?>" class="card-img-top" style="width: 100%; height:200px;" alt="...">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $mentor[$k]['name']; ?></h5>
                                <p class="card-title"><?php echo $mentor[$k]['study']; ?></p>
                                <p class="card-title"><?php echo $mentor[$k]['university'] . " , ", $mentor[$k]['country']; ?></p>
                                <p class="card-title"><?php echo $mentor[$k]['subject']; ?></p>
                                <p class="card-title"><?php  ?></p>
                                <p class="card-title"><?php echo $mentor[$k]['current_work']; ?></p>
                            </div>
                        </div>
                    </div>


            <?php
                }
            }
            ?>
        </div>
        <h1 style="text-align: center; margin: 5px">Live with Mentors</h1>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Mentor</th>
                    <th scope="col">Last enroll date</th>
                    <th scope="col">live Date</th>
                    <th scope="col">live time</th>
                    <th scope="col">level of study</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stuId = $_SESSION["user_id"];
                $mentorlive = $db->readData("SELECT * FROM mentor_live");
                if (!empty($mentorlive)) {
                    foreach ($mentorlive as $k => $v) {
                        $id = $mentorlive[$k]['id'];
                        $mentorId = $mentorlive[$k]['mentorId'];
                        $sql = "SELECT name,study FROM mentor WHERE id = $mentorId";
                        $mentor = $db->readData($sql);
                        // get university information
                ?>
                        <form action="mentor.php" method="post">
                            <tr>
                                <th scope="row"><?php echo $mentor[0]['name']; ?></th>
                                <td><?php echo $mentorlive[$k]['enrolled_last_date']; ?></td>
                                <td><?php echo $mentorlive[$k]['live_Date']; ?></td>
                                <td><?php echo $mentorlive[$k]['live_time']; ?></td>
                                <td><?php echo $mentor[0]['study']; ?></td>
                                <th>
                                    <?php
                                    $sql = "SELECT * FROM `enrolled_class` WHERE `mentorLiveId` = $id AND `stu_id`= $stuId ";
                                    $enrolled = $db->readData($sql);
                                    if (empty($enrolled)) {
                                    ?>
                                        <div class="form-btn mt-3">
                                            <a href="mentor.php?mentor_live_id=<?php echo $id; ?>" class="btn btn-success">enroll</a>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="form-btn mt-3">
                                            <p class="btn btn-success">enrolled</p>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                </th>
                            </tr>
                        </form>
            </tbody>
    <?php
                    }
                }
    ?>
        </table>
    </div>
    <!-- Bootstrap 5  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>

</html>