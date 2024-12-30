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
    <h1>Add scholarships </h1>
    <div class="container mt-5" style="width: 60vw; min-width: 300px">
        <form action="addScholarships.php" method="post">
            <!-- Application -->
            <div class="row mb-3">
                <div class="col">
                    <label for="">Date</label>
                    <input type="number" class="form-control" name="date" placeholder="">
                </div>
                <div class="col">
                    <label for="">status</label>
                    <textarea name="status" id=""></textarea>
                </div>
                <div class="col">
                    <label for="form-label">Select university</label>
                    <select class="form-select form-select-lg mb-3" aria-label="Large select example" name="Selected_university">
                        <?php
                        require_once "../db.php";
                        $db = new DBController();
                        $sql = "SELECT * FROM university";
                        $universities = $db->readData($sql);
                        $firstOne = true;
                        if (!empty($universities)) {
                            foreach ($universities as $university) {
                                if ($firstOne) {
                                    echo "<option value='" . $university['id'] . "' selected>" . $university['name'] . "</option>";
                                    $firstOne = false;
                                } else {
                                    echo "<option value='" . $university['id'] . "'>" . $university['name'] . "</option>";
                                }
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <!-- Application -->
            <div class="row mb-3">
                <div class="col">
                    <label for="">Title</label>
                    <input type="text" class="form-control" name="title" placeholder="">
                </div>
                <div class="col">
                    <label for="">Describe</label>
                    <textarea name="describe" id=""></textarea>
                </div>
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
                        <optioSn value="New_Zealand">New Zealand</optioSn>
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
    // start Application

    $date = $_POST["date"];
    $status = $_POST["status"];
    $university_id = $_POST['Selected_university'];


    if ($date == "" || $status == "") {
        echo "Please fill all the fields";
    } else {
        require_once "../db.php";
        $db = new DBController();
        $sql = "INSERT INTO application (`applicatioDate`, `status`, `universityId`) VALUES ('$date', '$status', '$university_id')";
        $application_id = $db->insertData($sql);
        if ($application_id > 0) {
            // echo "Application added successfully";

            $title = $_POST["title"];
            $desc = $_POST["describe"];
            $country = $_POST['Selected_country'];
            $studyLevel = $_POST['Scholarship_for'];

            if (!empty($title) && !empty($desc)) {
                $sql = "INSERT INTO `scholarship`(`title`, `description`, `levelOfStudy`, `universityId`, `applicationId`, `country`) VALUES
         ('$title','$desc','$studyLevel','$university_id','$application_id','$country')";
                $idontneedit = $db->insertData($sql);
                if ($idontneedit > 0) {
                    echo "<div class='alert alert-success'> Added sucessfully.</div>";
                }
            }
        } else {
            echo "Failed to add application";
        }
    }

    // end Application

}
?>