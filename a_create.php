<?php
ob_start();
session_start();

require_once 'db_conn11.php';

// if session is not set this will redirect to login page
if (!isset($_SESSION['admin'])) {
    header("Location: index.php");
    exit;
}

if (!isset($_SESSION['spradmin']) !="") {
    header("Location: index.php");
    exit;
}
// select logged-in users details
$res = mysqli_query($connect, "SELECT * FROM users WHERE id=" . $_SESSION['admin']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);


?>


<?php 

if ($_POST) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $type = $_POST['aniType'];
    $descr = $_POST['descr'];
    $hob = $_POST['hobbies'];
    $image = $_POST['image'];
    $loc = $_POST['location'];

    

$sql = "INSERT INTO animals (`name`, age, aniType, descr, hobbies, `image`, `location`) 
VALUES ('$name', '$age', '$type', '$descr', '$hob', '$image', '$loc')";




if($connect->query($sql) === TRUE)
{
    echo "<h3>succesfuly updated <h3><br> <a href='../home.php'>Back Home</a>";
    header("Refresh:1; url=home.php");
} else {
    echo "error dhu check your code again";
}


/*
if ($_POST){
    $uname = $_POST['userName'];
    $post = $_POST['position'];

    $sql = "INSERT INTO user (userName, position) VALUES ('$uname', '$post')";

    if($connect->query($sql) === TRUE)
    {
        echo "<h3>succesfuly updated <h3><br> <a href='../home.php'>Back Home</a>";
        header("refresh:1 url=home.php");
    } else {
        echo "error dhu check your code again";
    }

}*/

$connect->close();
}
?>