<?php
$total_price=0;
$total_tax=0;
$total_discount=0;

if(!isset($_SESSION['user'])){
 header("location:login.php");
}
include'db/conn.php';

$image="";
$id_user="";
$id_products="";

$user=$_SESSION['user'];
$_SESSION['name']="";
$_SESSION['pic']="";
$_SESSION['country']="";
$_SESSION['city']="";
if(isset($_SESSION['user'])){
	$all_user_info=$conn->query("SELECT * FROM users where email='$user'");
	if($all_user_info->num_rows==1){
		while($row=$all_user_info->fetch_assoc()){
			$_SESSION['name']=$row['full_name'];
			$_SESSION['pic']=$row['pic'];
			$_SESSION['country']=$row['country'];
			$_SESSION['city']=$row['city'];
		}
	}
}
?>

	<div class="row" style="margin-top: 0px;margin-right: 2px;margin-bottom: 10px;">
		<div class="col-md-9">
			
		</div>
		<div class="col-md-3 pull-right" style="height: 80px;width: 270px;background-color: rgb(250,250,250);border-radius: 30px 60px 60px 30px;border:1px solid skyblue">
			<img src="<?php echo $_SESSION['pic'];?>" class="img-responsive img-circle pull-right" style="width: 60px;height: 60px;margin-right: -5px;margin-top: 10px;border:1px solid white">
			<u><a href="profile.php">Profile</a></u> <p>Hi Welcome ...</p>
			<p><?php echo $_SESSION['name'];?></p>
				
				
					

					
		</div>
	</div>
