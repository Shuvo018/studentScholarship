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
    <h1 style="text-align: center;">ADMIN </h1>
    <div class="container">
        <div class="row m-3">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add University</h5>
                        <p class="card-text">Here you can add university.</p>
                        <a href="addUniversity.php" class="btn btn-primary">Add</a>

                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Scholarships</h5>
                        <p class="card-text">Here you can add scholarships.</p>
                        <a href="addScholarships.php" class="btn btn-primary">Add</a>

                    </div>
                </div>
            </div>
        </div>
        <div class="row m-3">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Mentor</h5>
                        <p class="card-text">Here you can add mentor</p>
                        <a href="addMentor.php" class="btn btn-primary">Add</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Add Blog</h5>
                        <p class="card-text">Here you can add blog</p>
                        <a href="addBlogAdmin.php" class="btn btn-primary">Add</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h1 style="text-align: center; margin: 5px">Over all details</h1>
    <div class="container">
        <?php
        require_once '../db.php';
        $db = new DBController();

        $users = $db->readData("SELECT * FROM `student`");
        $university = $db->readData("SELECT * FROM `university`");
        $scholarship = $db->readData("SELECT * FROM `scholarship`");
        $blog = $db->readData("SELECT * FROM `blog`");
        $mentor = $db->readData("SELECT * FROM `mentor`");

        ?>
        <div class="row m-2">
            <div class="col-sm-6">
                <div class="card  text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total user</h5>
                        <p class="card-text">Number of user <?php echo count($users); ?> </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card  text-white bg-danger">
                    <div class="card-body">
                        <h5 class="card-title">Total Universities</h5>
                        <p class="card-text">Number of Universities <?php echo count($university); ?></p>
                    </div>
                </div>
            </div>

        </div>
        <div class="row m-2">
            <div class="col-sm-6">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Total Scholarships</h5>
                        <p class="card-text">Number of scholar <?php echo count($scholarship); ?></p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Total blogs</h5>
                        <p class="card-text">Number of user <?php echo count($blog); ?> </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row m-2">
            <div class="col-sm-6">
                <div class="card text-white bg-secondary">
                    <div class="card-body">
                        <h5 class="card-title">Total Mentors</h5>
                        <p class="card-text">Number of mentors <?php echo count($mentor); ?></p>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Bootstrap 5  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>

</html>