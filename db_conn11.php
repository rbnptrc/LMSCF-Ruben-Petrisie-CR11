<?php 
#error_reporting( ~E_DEPRECATED & ~E_NOTICE );
#class Database {}
$localhost = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "cr11_ruben_petadoption";

// create connection

$connect = new mysqli($localhost, $username, $password, $dbname);
if($connect->connect_error) {
    die("connection failed: " . $connect->connect_error);
} else {
    //echo "Successfull conectd";
}
?>