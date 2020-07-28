<?php
	$connect = mysqli_connect("localhost","root","","cr11_ruben_petadoption");
$output ="";

	//set up
if (isset($_POST['search'])){
	$searchq = $_POST['search'];

	$searchq = preg_replace("#[^0-9a-z]#i","", $searchq);

	$res = $connect->query("SELECT * FROM animals WHERE `name` LIKE '%name%'") ;
	$count = mysqli_num_rows($res); 
	if ($count == 0) {
		$output = 'Nothing found';
	}else {
		while ($row = mysqli_fetch_array($res, MYSQLI_ASSOC));
		$name = $row['name'];

		$output .= '<div> '.$name. ' </div><br>';
	}
}

/*
	$search = $_POST["search"];
	// $search = isset($_POST["search"]) ? $_POST["search"] : "null"

	$sql = "SELECT * FROM animals WHERE `name` LIKE '%$search%'";

	$result = mysqli_query($connect, $sql);
    
    if($result->num_rows == 0){
		echo "Nothing Found";
	}else
	 {
		echo "try again";
	}
*/
?>

<?php print("$output");?>