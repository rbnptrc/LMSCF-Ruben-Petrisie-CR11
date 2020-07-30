<?php


require_once 'db_conn11.php';



if ($_POST) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $type = $_POST['aniType'];
    $descr = $_POST['descr'];
    $hobbies = $_POST['hobbies'];
    $image = $_POST['image'];
    $location = $_POST['location'];

    

$sql = "INSERT INTO animals (`name`, age, aniType, descr, hobbies, `image`, `location`) 
VALUES ('$name', '$age', '$type', '$descr', '$hobbies', '$image', '$location')";




if($connect->query($sql) === TRUE)
{
    echo "<center><h3>succesfuly Created </h3></center>";
    header("refresh:1 url=admin.php");
} else {
    echo "error dhu check your code again";
}


$connect->close();
}

// select logged-in users details
/*$res = mysqli_query($connect, "SELECT * FROM users WHERE id=" . $_SESSION['admin']);
$userRow = mysqli_fetch_array($res, MYSQLI_ASSOC);*/


?>

