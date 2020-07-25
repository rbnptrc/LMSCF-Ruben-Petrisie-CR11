<?php
ob_start();
session_start();

require_once 'db_conn11.php';

if (isset($_SESSION['user'])){
    header("Location: index.php");
    exit;
    $res=mysqli_query($mysqli, "SELECT * FROM users WHERE userType=". $_SESSION['user']. "");
    $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
}
    
	if (isset($_SESSION['admin'])){
        header("Location: index.php");
        exit;
        $res=mysqli_query($mysqli, "SELECT * FROM users WHERE userType=". $_SESSION['admin']. "");
        $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);
	}
// select logged-in users details
#$res = mysqli_query($connect, "SELECT * FROM users WHERE userId=" . $_SESSION['user']);
#$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);

if(isset($_POST['login'])){
    $email = $_POST['userEmail'];
    $pass = $_POST['passw'];

    
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
        $res = $connect->query("SELECT userId, userName, userPass FROM users WHERE userEmail='$email'");
        $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
        $count = mysqli_num_rows($res); // if uname/pass is correct it returns must be 1 row

        if ($count == 1 && $row['userPass'] == $password) {
            $_SESSION['user'] = $row['userId'];
            header("Location: home.php");
        } else {
            $errMSG = "Incorrect Credentials, Try again...";
        }
    }
    // Close connection
    $connect->close();
}


?>