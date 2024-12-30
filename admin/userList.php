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
    <?php
    require_once '../db.php';
    $db = new DBController();

    $users = $db->readData("SELECT * FROM `student`");
    $university = $db->readData("SELECT * FROM `university`");


    ?>
    <div class="container">
        <div class="row m-2">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Universities</h5>
                        <p class="card-text">Here you can add university.</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Total Universities</h5>
                        <p class="card-text">Here you can add university.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First</th>
                <th scope="col">Last</th>
                <th scope="col">Handle</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
            </tr>
            <tr>
                <th scope="row">2</th>
                <td>Jacob</td>
                <td>Thornton</td>
                <td>@fat</td>
            </tr>
            <tr>
                <th scope="row">3</th>
                <td colspan="2">Larry the Bird</td>
                <td>@twitter</td>
            </tr>
        </tbody>
    </table>
</body>

</html>