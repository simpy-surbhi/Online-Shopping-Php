<?php
if(isset($_FILES['picture'])){
	$photo_name=$_FILES['picture']['name'];
		$photo_type=$_FILES['picture']['type'];
		$photo_temp_loc=$_FILES['picture']['tmp_name'];
		$photo_store="photos/".$photo_name;
		
		$photo_store="temp/".$photo_name;
		if(move_uploaded_file($photo_temp_loc, $photo_store)){
			echo $photo_store;
		}
		
}

?>