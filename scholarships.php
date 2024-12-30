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
    <!-- Navigation -->
    <?php
    include('nav.php');
    if (!isset($_SESSION["user"])) {
        header('Location: login.php');
    }
    ?>
    <!-- php -->

    <!-- php -->
    <div class="col-12 text-center">
        <img src="images/33208959_2206.q703.011.S.m004.c12.global education student exchange cartoon.jpg" alt="Global Scholarships" class="img-fluid rounded shadow-lg mb-4">
        <h2 class="text-center mb-4">Available Scholarships</h2>
    </div>
    <div class="container d-flex justify-content-center ">
        <form action="scholarships.php" method="post" style="width: 50vw; min-width: 300px;">
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
            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="search" name="submit">
            </div>
        </form>
    </div>
    <div class="container my-5">


        <h2>All</h2>
        <div class="row">
            <?php
            if (isset($_POST['submit'])) {
                $country = $_POST['Selected_country'];
                $scholarship = $_POST['Scholarship_for'];
                $sql = "SELECT * FROM scholarship WHERE country='$country' and levelOfStudy='$scholarship'";
            } else {
                $sql = "SELECT * FROM scholarship";
            }
            $rows = $db->readData($sql);
            print_r(empty($rows));
            if (!empty($rows)) {
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
            ?>
        </div>
    </div>

    <!-- Bootstrap 5  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
<!-- trash -->