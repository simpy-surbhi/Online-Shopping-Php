<?php
include"db/conn.php";
include"header.php";

session_start();
$err_change_pass="";
if (isset($_GET['update']) && isset($_GET['user'])) {
	
      $_SESSION['comfirmation']=$_GET['update'];
      $_SESSION['com_email']=$_GET['user'];
	
}
if(isset($_POST['submit'])){
	$id=$_SESSION['comfirmation'];
	$user=$_SESSION['com_email'];
	$pass=md5($_POST['pass']);

	$check=$conn->query("SELECT * FROM users WHERE id_update='$id' and email='$user'");

	if($check->num_rows>0){
		while($wright_infos=$check->fetch_assoc()){
			$wright_email=$wright_infos['email'];
			$wright_name=$wright_infos['full_name'];
		}
		$update=$conn->query("UPDATE users set password='$pass' where email='$wright_email' and full_name='$wright_name'");
		if($update===TRUE){
			echo "<script>alert(' Password  changed Successfully! click OK to login')</script>";
			header("Location:login.php");
		}else{
			$err_change_pass="Password was not changed please try again!";
				}
	}
	
}
?>

<!DOCTYPE html>
<html>
<head>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/user.css">
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="assets/bootstrap/fonts/font-awesome.min.css">
</head>
	<title>Change Password</title>
</head>
<body>
<div class="container"> 
	<div class="row">
		<div class="col-md-3">
			
		</div>
		<div class="col-md-3">
			<form class="form" style="margin-top:50%;" id="form" method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
			<h3>Please enter New Password and Confirm</h3>
			<?= $err_change_pass; ?>
				<div class="form-group">
					<label>New Password:</label>
					<input type="password" name="pass" id="pass" class="form-control">
					<span class="text-danger" id="err_pass"></span>
				</div>
				<div class="form-group">
					<label>Confirm Password:</label>
					<input type="password" name="com_pass" id="com_pass" class="form-control">
					<span id="err_com_pass" class="text-danger"></span>
				</div>
				<div class="form-group">
					<input type="submit" name="submit" class="btn btn-primary" value="Change Password">
				</div>
			</form>
		</div>
		<div class="col-md-3">
			
		</div>
	</div>
</div>
</body>
<script>
	$(function(){
			$("#err_com_pass").hide();
			$("#err_pass").hide();


			var err_com_pass=false;
			var err_pass=false;


			$("#pass").focusout(function(){
			check_pass();
			});
			$("#com_pass").focusout(function(){
			check_com_pass();
			});

			function check_pass(){
				var a=$("#pass").val().length;
				if(a<8 ){
					$("#err_pass").html("At least 8 letters");
					$("#pass").css("border","1px solid red");
					$("#err_pass").show();
					err_pass=true;
				}else{
					$("#err_pass").hide();
					$("#pass").css("border","1px solid #ccc");
				}
			}
			function check_com_pass(){
				var a=$("#com_pass").val();
				var b=$("#pass").val();
				if(a!=b ){
					$("#err_com_pass").html("Password doesn't match");
					$("#com_pass").css("border","1px solid red");
					$("#err_com_pass").show();
					err_com_pass=true;
				}else{
					$("#err_com_pass").hide();
					$("#com_pass").css("border","1px solid #ccc");
				}
			}

			$("#form").submit(function(){
				err_com_pass=false;
				err_pass=false;

				check_com_pass();
				check_pass();

				if(err_com_pass==false && err_pass==false){
					return true;
				}else{
					return false;
				}



			});

	});
</script>
</html>