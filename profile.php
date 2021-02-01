<?php
include 'db/conn.php';
include 'header.php';

if(!isset($_SESSION['user'])){
 header("location:login.php");
}


$user=$_SESSION['user'];
if(isset($_POST['upload'])){
	

	$alain=$conn->query("SELECT * from users where email ='$user' ");
	if($alain->num_rows>0){


		while($row=$alain->fetch_assoc()){
			$username=$row['full_name'];
		}
		$msg="";
		$photo_name=$_FILES['picture']['name'];
		$photo_type=$_FILES['picture']['type'];
		$photo_size=$_FILES['picture']['size'];
		$photo_temp_loc=$_FILES['picture']['tmp_name'];
		if(!is_dir("profiles/$username")){
			mkdir("profiles/$username");
		}
		$photo_store="profiles/$username/".$photo_name;
		if(move_uploaded_file($photo_temp_loc,$photo_store)){
			$msg="hello";
		}
		$insert=$conn->query("UPDATE users SET pic='$photo_store' where email='$user'");
		if($insert===TRUE){
			echo "<script> alert('Profile picture successfully uploaded');window.location='profile.php'</script>";

		}
		else{
			echo "<script> alert('Profile picture unsuccessfully uploaded')</script>";
			
			}
	}

	
}
?>
<br><br><br><br>
<div class="container">
	<h2>Profile Settings Data</h2>
<table class="table table-bordered " style="width: 50%;float: left;">
<tr>
	<th style="font-size: 19px;color: skyblue;">Subject</th>
	<th style="font-size: 19px;color: skyblue;">Data</th>
</tr>
<?php
	$email=$_SESSION['user'];
	$alain=$conn->query("SELECT * from users where email='$email'");
	while($show_table=$alain->fetch_assoc()){



?>
<tr>
	<th>Full Name</th>
	<td><?php echo $show_table['full_name'] ?></td>

</tr>
<tr>
	<th>Email</th>
	<td><?php echo $show_table['email'] ?></td>
</tr>
<tr>
	<th>Company</th>
	<td><?php echo $show_table['company'] ?></td>
</tr>
<tr>
	<th>Country</th>
	<td><?php echo $show_table['country'] ?></td>
</tr>

<?php

}

?>
</table>
<div class="" style="width: 24%;float: right;">
	<?php include"info.php";?>
	<form class="form " method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
		<div class="form-group">
			
			<label>Select Profile Picture</label>
			<input type="file" name="picture"  class="" required="">
		</div>
		<div class="form-group">
			<input type="submit" value="Upload" name="upload" class="form-control btn btn-success" >
		</div>

	</form>
</div>

</div>


<br>
<br>
<br>
<br>
<br>
<br>
<br>

<?php

include 'footer.php';
?>