<?php
include"db/conn.php";
include"header.php";
$email_err="";
$msg_result="";
$conts="";
if (isset($_POST['submit'])) {
	$email=$_POST['email'];
	$check=$conn->query("SELECT email,full_name from users where email='$email'");
	$conts=$email;
	if($check->num_rows>0){
		while($row=$check->fetch_assoc()){
			$user=$row['full_name'];

		}
		random_bytes(100);
		$random=random_int(1000, 9000);
		$link='<a href="change_pass.php?update='.$random.'&user='.$email.'">Click here</a>';
		$send=$conn->query("UPDATE users set forget_password='$link',id_update='$random' where email='$email'");
		if($send===TRUE){
		
		$to=$email;
		$subject="Password Recovery!<br>";
		$msg="Dear '$user' <br>Recently we have gained your procraim about recovering password<br> So click on this link to '.$link.' change Password </a>";
		$header="Like us on fb";
		if(mail($to,$subject,$msg,$header)){
			$msg_result="MESSAGE WAS SENT SUCCESSFULLY!";
		}else{
			$msg_result="MESSAGE WAS NOT SENT";
			}
		}
		
	}
	else{
		$email_err="No email associated with your email try again!";
	}
}



?>
<!DOCTYPE html>
<html>
<head>
	<title>Forget Password</title>
</head>

<body style="background-color:rgb(242, 242, 242)">
<br><br><br><br><br><br><br><br>
<div class="container">
	<div class="row">
		<div class="col-md-3">
			
		</div>
		<div class="col-md-4">
			<form class="form " method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
			<h3>Please enter your email to renew password!</h3>
			
				<div class="form-group">
					<label>Email:</label>
					<input type="email" value="" name="email" placeholder="Email" class="form-control">
				</div>
				<div class="form-group">
					<input type="submit" name="submit" class="btn btn-primary pull-right" value="SEND">
					<h5 class="text-danger text-center"><?php echo $msg_result.$email_err; ?></h5>
				</div>
				
			</form>
		</div>
		<div class="col-md-3">
			
		</div>
		
	</div>
</div>
</body>
</html>