<?php
ob_start();
session_start();

require_once 'db_conn11.php';

// it will never let you open index(login) page if session is set
if ( isset($_SESSION['user' ])!="" ) {
    header("Location: home.php");
    exit;
  }


  if(isset($_SESSION['admin']) != ''){
    header("Location: admin.php");
    exit;
  }


  if(isset($_SESSION['spradmin']) != ''){
    header("Location: spradmin.php");
    exit;
  }



$emailError = "";
$passError = "";


$error = false;

if (isset($_POST['btn-login'])) {



    // prevent sql injections/ clear user invalid inputs
    $email = trim($_POST['userEmail']);
    $email = strip_tags($email);
    $email = htmlspecialchars($email);

    $pass = trim($_POST['passw']);
    $pass = strip_tags($pass);
    $pass = htmlspecialchars($pass);
    // prevent sql injections / clear user invalid inputs



    if (empty($email)) {
        $error = true;
        $emailError = "Please enter your email address.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $emailError = "Please enter valid email address.";
    }

    if (empty($pass)) {
        $error = true;
        $passError = "Please enter your password.";
    }

    // if there's no error, continue to login
    if (!$error) {

        $password = hash('sha256', $pass); // password hashing - sha256

        
        //this needs checking again *
        $res = $connect->query("SELECT * FROM users WHERE userEmail='$email'");
        $row = mysqli_fetch_array($res, MYSQLI_ASSOC);

        $count = mysqli_num_rows($res); // if uname/pass is correct it returns must be 1 row

        if ($count == 1 && $row['passw'] == $password && $row['userType'] =='admin'){
            $_SESSION['admin'] = $row['id'];
            header("Location: admin.php");
        } elseif ($count == 1 && $row['passw'] == $password && $row['userType'] =='user'){
            $_SESSION['user'] = $row['id'];
            header("Location: home.php");
        }elseif ($count == 1 && $row['passw'] == $password && $row['userType'] =='spradmin'){
            $_SESSION['spradmin'] = $row['id'];
            header("Location: spradmin.php");
        }else {
            $errMSG = "Incorrect Credentials, Try again...";
        }


  
    }
    // Close connection
    $connect->close();
}
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
                    <a class="nav-link" href="#">Log in</a>
                </li>
            </ul>

            <span class="navbar-text px-md-5">
                <i class="fa fa-user"></i>
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
    <div class="row justify-content-center">
        <form method="post" action="<?= htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

            <h2>Please Log in</h2>
            <hr/>

            <?php
            if (isset($errMSG)) {
                echo $errMSG;
            ?>
            <?php
            }    //* some php wrapping stuff ?
            ?>
           
                <label>Email</label>
                <input type="email" name="userEmail" class="form-control" placeholder="Your Email" maxlength="40" />
                <span class="text-danger"><?php echo $emailError; ?></span>
           
                <label>Password</label>
                <input type="password" name="passw" class="form-control" placeholder="Your Password" maxlength="15" />
                <span class="text-danger"><?php echo $passError; ?></span>
                <br>
<!---
                <label>UserType</label>
                <select name="userType">
                    <option value="user">user</option>
                    <option value="admin">admin</option>
                    <option value="spradmin">spradmin</option>
                </select>
--->       
                <hr/>
                <button type="submit" name="btn-login" class="btn btn-primary">Log In</button>
                <hr/>
        
            <a href="logout.php?logout"><button type="submit" class="btn btn-danger">Log Out</button></a>

        </form>

    </div>



        <!-- jQuery & Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>
<?php ob_end_flush(); ?>