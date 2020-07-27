<?php
	$conn = mysqli_connect("localhost","root","","cr11_ruben_petadoption");

	$search = $_POST["search"];
	// $search = isset($_POST["search"]) ? $_POST["search"] : "null"

	$sql = "SELECT * FROM animals WHERE `name` LIKE '%$search%'";

	$result = mysqli_query($conn, $sql);
    
    if($result->num_rows == 0){
		echo "Nothing Found";
	}else
	 {
		echo "try again";
	}

?>