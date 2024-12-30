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
    <h1>Add application </h1>
    <div class="container mt-5" style="width: 60vw; min-width: 300px">
        <form action="addApplication.php" method="post">
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
                        <option value="1" selected>Clark University</option>
                        <option value="2">Harvard University</option>
                        <option value="3">Yale University</option>
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
    $date = $_POST["date"];
    $status = $_POST["status"];
    $university_id = $_POST['Selected_university'];

    echo $university;
    if ($date == "" || $status == "") {
        echo "Please fill all the fields";
    } else {
        require_once "../db.php";
        $db = new DBController();
        $sql = "INSERT INTO application (`applicatioDate`, `status`, `universityId`) VALUES ('$date', '$status', '$university_id')";
        $application_id = $db->insertData($sql);
        if ($application_id > 0) {
            session_start();
            $_SESSION['application_id'] = $application_id;
            $_SESSION['university_id'] = $university_id;
            echo "Application added successfully";
            header("Location: addScholarships.php");
        } else {
            echo "Failed to add application";
        }
    }
}
?>