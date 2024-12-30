<?php
$id = $_GET['scholarship_id'];

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
    include('nav.php')
    ?>
    <?php
    // get scholarship information
    $sql = "SELECT * FROM scholarship WHERE id = $id";
    $rows = $db->readData($sql);

    if (!empty($rows)) {
        // get university information
        $uni_id = $rows[0]['universityId'];
        $application_id = $rows[0]['applicationId'];

        $sql2 = "SELECT * FROM university WHERE id = $uni_id";
        $rows2 = $db->readData($sql2);

        $sql3 = "SELECT * FROM application WHERE id = $application_id";
        $rows3 = $db->readData($sql3);

        if (!empty($rows2) && !empty($rows3)) {
            $uni_name = $rows2[0]['name'];
            $uni_image = $rows2[0]['image'];
            $url = $rows2[0]['websiteLink'];

            $appli_date = $rows3[0]['applicatioDate'];
            $status = $rows3[0]['status'];
    ?>
            <div class="container card w-75">
                <div class="card-body">
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($uni_image); ?>" alt="Image">
                    <h5 class="card-title"><span class="fs-2"><?php echo $rows[0]['title']  ?></span></h5>
                    <p class="card-text"><span class="fs-3">Country :</span> <?php echo $rows[0]['country'] ?></p>
                    <p class="card-text"><span class="fs-3">University :</span> <?php echo $uni_name ?></p>
                    <p class="card-text"><span class="fs-3">Level of Study:</span> <?php echo $rows[0]['levelOfStudy'] ?></p>
                    <p class='card-text'><span class="fs-3">Website link:</span> <a href="<?php echo htmlspecialchars($url) ?>"><?php echo htmlspecialchars($url) ?></a></p>
                    <p class="card-text"><span class="fs-3">Status :</span> <?php echo $status; ?></p>

                    <p class="card-text font-size"><span class="fs-3">Description :</span><?php echo $rows[0]['description'] ?></p>

                </div>
            </div>
            <a href=""></a>

    <?php
        }
    }
    ?>
    <!-- Bootstrap 5  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
<!-- trash -->