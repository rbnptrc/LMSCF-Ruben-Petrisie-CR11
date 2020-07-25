<?php
ob_start();
session_start();

require_once 'db_conn11.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}
// select logged-in users details
$res = mysqli_query($connect, "SELECT * FROM users WHERE id=" . $_SESSION['admin']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ruben CR11</title>
    <link rel="stylesheet" type="text/css" href="style.css" />

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <!-- Nav -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="home.php">Adopt a Pet</a>
        <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
                    <li class="nav-item">
                    <a class="nav-link" href="general.php">General</a>
                    <li class="nav-item">
                    <a class="nav-link" href="senior.php">Senior</a>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Log in</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Log Out</a>
                </li>
            </ul>

            <span class="navbar-text px-md-5">
                <i class="fa fa-user"></i>
                <?= $userRow['userName']; ?>
            </span>
            </ul>

            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
    </nav>

    <!--hero-->
    <header>
        <div class="jumbotron main_header">
            <h1 class="display-4">Get a Pet</h1>

        </div>
    </header>

    <!--Content Area--->


    <?php
    // display employee data + info

    $sql = "SELECT * FROM animals";
    $resa = $connect->query($sql);

    //pre_r($res);
    ?>


    <div class="container">
    <div class="admin-area">
    <h2>Hello! <?= $userRow['userName']; ?></h2>
    <h2>This is your admin Panel, You may Edit The sections</h2>
    <br>
</div>
<hr>
    <div class="card-group">
        <?php while ($row = $resa->fetch_assoc()) : ?>
            <div class="col-sm-10 col-md-5 col-lg-3 mt-5">
                <div class="card">
                    <img src=" <?= $row['image']; ?>" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">Name:  <?= $row['name']; ?></h5>
                        <p class="card-text">Age:  <?= $row['age']; ?></p>
                        <p class="card-text">Description:  <?= $row['descr']; ?></p>
                        <p class="card-text">Hobbies:  <?= $row['hobbies']; ?></p>
                        <p class="card-text">Location:  <?= $row['location']; ?></p>
                        <a href="update.php?id=<?= $row['id'] ?>" class="btn btn-warning">Update</a>
                       <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger">Delete</a>
                   </div>
               </div>
           </div>
           <?php endwhile; ?>       
        </div>
    </div>


        <!-- jQuery & Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>