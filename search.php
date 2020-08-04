<?php
	$connect = mysqli_connect("localhost","root","","cr11_ruben_petadoption");


	//set up


	$search = $_POST["search"];
	// $search = isset($_POST["search"]) ? $_POST["search"] : "null"

	$sql = "SELECT * FROM animals WHERE `name` LIKE '%$search%'
	OR aniType LIKE '%$search%' OR hobbies LIKE '%$search%'";

	$result = mysqli_query($connect, $sql);
    
    if($result->num_rows == 0){
		echo "No result";
	}elseif($result->num_rows == 1){
		$row = $result->fetch_assoc();
		echo '
    
            <div class="card col-3 mt-3 p-2">
                <img class="card-img-top" src="'.$row["image"].'" style="width:100%; height:15vw;">
                <div class="card-body">
                  <h5 class="card-title ">'.$row["name"].'</h5>
                  <p class="card-text">Age: '.$row["age"].'</p>
                  <p class="card-text">Type: '.$row["aniType"].'</p>
                  <p class="card-text">Hobby: '.$row["hobbies"].'</p>
                  <p class="card-text">City: '.$row["location"].'</p>
                </div>
            </div>
    
    ';
	}else {
		$rows = $result->fetch_all(MYSQLI_ASSOC);
		foreach ($rows as $row) {
			echo '
    
            <div class="card col-3 mt-3 p-2">
                <img class="card-img-top" src="'.$row["image"].'" style="width:100%; height:15vw;">
                <div class="card-body">
                  <h5 class="card-title ">'.$row["name"].'</h5>
                  <p class="card-text">Age: '.$row["age"].'</p>
                  <p class="card-text">Type: '.$row["aniType"].'</p>
                  <p class="card-text">Hobby: '.$row["hobbies"].'</p>
                  <p class="card-text">City: '.$row["location"].'</p>
                </div>
            </div> ';
		}
	}
?>

