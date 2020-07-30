<?php


ob_start();
session_start(); // start a new session or continues the previous
if (isset($_SESSION['user']) !=""){
   header("Location: home.php"); // redirects to home.php
}

include_once 'db_conn11.php';


$error = false;
if (isset($_POST['btn-signup'])) {

    // sanitize user input to prevent sql injection
    $name = trim($_POST['userName']);

    //trim - strips whitespace (or other characters) from the beginning and end of a string
    $name = strip_tags($name);

    // strip_tags — strips HTML and PHP tags from a string
    $name = htmlspecialchars($name);

    // htmlspecialchars converts special characters to HTML entities
    $email = trim($_POST['userEmail']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['passw']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);


    // basic name validation
    if (empty($name)) {
        $error = true;
        $nameError = "Please enter your full name.";
    } else if (strlen($name) < 3) {
        $error = true;
        $nameError = "Name must have at least 3 characters.";
    } else if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
        $error = true;
        $nameError = "Name must contain alphabets and space.";
    }

    //basic email validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    } else {
        // checks whether the email exists or not
        $sql = "SELECT userEmail FROM users WHERE userEmail='$email'";
        $result = $connect->query($sql);
        $res = $result->fetch_assoc(); //noted*
        if ($res->num_rows != 0) {   //change
            $error = true;
            $emailError = "Provided Email is already in use.";
        }
    }
    // password validation
    if (empty($pass)) {
        $error = true;
        $passError = "Please enter password.";
    } else if (strlen($pass) < 6) {
        $error = true;
        $passError = "Password must have atleast 6 characters.";
    }

    // password hashing for security
    $password = hash('sha256', $pass);

    // if there's no error, continue to signup
    if (!$error) {

        $sql = "INSERT INTO users (userName, userEmail, passw) VALUES('$name','$email','$password')";
        $res = mysqli_query($connect, $sql);

        if ($res) { //change
            $errTyp = "success";
            $errMSG = "Successfully registered, you may login now";
            unset($name);
            unset($email);
            unset($pass);

        } else {
            $errTyp = "danger";
            $errMSG = "Something went wrong, try again later...";
        }
    }
}
// Close connection
$connect->close();

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
            <li class="nav-item">
                <a class="nav-link" href="index.php">Log in</a>
            </li>
          <!---  <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php">Home <span class="sr-only">(current)</span></a>
                    <li class="nav-item">
                    <a class="nav-link" href="general.php">General</a>
                    <li class="nav-item">
                    <a class="nav-link" href="senior.php">Senior</a>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Register</a>
            </ul>

            <span class="navbar-text px-md-5">
                <i class="fa fa-user"></i>
                
            </span>
            </ul>--->

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

<body>
    <!--content section--->
    <div class="container">

        <form method="post"action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>"  autocomplete="off">

            <h2>Register</h2>
            <hr />
            <?php
            if (isset($errMSG)) {

            ?>
                <div class="alert alert-<?= $errTyp ?>">
                    <?= $errMSG; ?>
                </div>
            <?php
            }
            ?>

            <input type="text" name="userName" class="form-control" placeholder="Enter Name" maxlength="50" value="<?php echo $name ?>" />
            <span class="text-danger"> <?php echo $nameError; ?> </span>

            <input type="email" name="userEmail" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />
            <span class="text-danger"> <?php echo $emailError; ?> </span>

            <input type="password" name="passw" class="form-control" placeholder="Enter Password" maxlength="15" value="<?php echo $pass ?>" />
            <span class="text-danger"> <?php echo $passError; ?> </span>
            <hr />
<!---
            <label>UserType</label>
                <select name="userType">
                    <option value="user">user</option>
                    <option value="admin">admin</option>
                    <option value="spradmin">spradmin</option>
                </select>
--->
            <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Register</button>
            <hr />


        </form>

    </div>


    <!-- jQuery & Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>

</html>
<?php ob_end_flush(); ?>