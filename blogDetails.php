<?php
$id = $_GET['blog_id'];

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
    $sql = "SELECT * FROM blog WHERE id = $id";
    $rows = $db->readData($sql);

    if (!empty($rows)) {
    ?>
        <div class="container card w-75 border-success mt-10">
            <div class="card-body">
                <h5 class="card-title"><?php echo $rows[0]['title'] ?></h5>
                <p class="card-text"><small class="text-muted"><?php echo $rows[0]['date'] ?></small></p>
                <p class="card-text"><span class="fs-4">Writer : </span><?php echo $rows[0]['writer'] ?></p>
                <p class="card-text"><span class="fs-4">Type : </span><?php echo $rows[0]['type'] ?></p>
                <p class="card-text"><?php echo $rows[0]['description'] ?></p>
            </div>
        </div>
    <?php
    }
    ?>
    <!-- Bootstrap 5  -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>
<!-- trash -->