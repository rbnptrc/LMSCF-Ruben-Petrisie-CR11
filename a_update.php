<?php 

require_once 'db_conn11.php';


if ($_POST){
    
    $name = $_POST['name'];
    $age = $_POST['age'];
    $type = $_POST['aniType'];
    $descr = $_POST['descr'];
    $hob = $_POST['hobbies'];
    $image = $_POST['image'];
    $loc = $_POST['location'];

    $id = $_POST['id'];


    $sql = "UPDATE animals SET name='$name', age='$age', aniType='$type', descr='$descr', hobbies='$hob', `image`='$image', `location`='$loc' WHERE id= $id ";

    if($connect->query($sql) === TRUE)
    {
        echo "<center><h3>succesfuly updated </h3></center>";
        header("refresh:1 url=admin.php");
    } else {
        echo "error dhu check your code again";
    }
}

$connect->close();

?>