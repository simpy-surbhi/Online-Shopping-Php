<?php
include'db/conn.php';
include"header.php";
$err="";
$unknown="";
session_start();






if(isset($_POST['login'])){
	$email=$_POST['email'];
	$pass=md5($_POST['pass']);

	$check=$conn->query("SELECT * FROM users  WHERE email='$email' and password='$pass' ");
	if($check->num_rows > 0){
	  if(isset($_POST['remember'])){
		setcookie('email',$email,time()+60*60*30);
		random_bytes(100);
		$random=random_int(20000,1000000000);
		$update=$conn->query("UPDATE users set identity='$random' where email='$email' and password='$pass'");
		setcookie('identity',$random,time()+60*60*30);


			
		}
		
		session_start();
		$_SESSION['user']=$email;
		header("Location:index.php");


	}else{
		$admin=$conn->query("SELECT * FROM admin WHERE email='$email' and password='$pass' ");
		if($admin->num_rows>0){
			if(isset($_POST['remember'])){
			setcookie('email',$email,time()+60*60*30);
			random_bytes(100);
			$random=random_int(20000,1000000000);
			$update=$conn->query("UPDATE admin set identity='$random' where email='$email' and password='$pass'");
			setcookie('identity',$random,time()+60*60*30);


			
		}
		session_start();
		$_SESSION['user']=$email;
		header("Location:admin.php");

		}else{
			$unknown="Invalid E-mail or Password";
		}
	}


}


if(isset($_COOKIE['email']) && isset($_COOKIE['identity'])){
	$email=$_COOKIE['email'];
	$identity=$_COOKIE['identity'];
	$check=$conn->query("SELECT * FROM users  WHERE email='$email' and identity='$identity' ");
		if($check->num_rows > 0){
	  
		
		random_bytes(100);
		$random=random_int(20000,1000000000);
		$update=$conn->query("UPDATE users set identity='$random' where email='$email' and identity='$identity'");
		setcookie('identity',$random,time()+60*60*30);		
		session_start();
		$_SESSION['user']=$email;
		header("Location:index.php");


	}else{
		$admin=$conn->query("SELECT * FROM admin WHERE email='$email' and identity='$identity' ");
		if($admin->num_rows>0){			
		random_bytes(100);
		$random=random_int(20000,1000000000);
		$update=$conn->query("UPDATE admin set identity='$random' where email='$email' and identity='$identity'");		
		session_start();
		$_SESSION['user']=$email;
		header("Location:admin.php");

		}
	}


}



if(isset($_SESSION['user'])){
	$email=$_SESSION['user'];
	
	$check=$conn->query("SELECT * FROM users  WHERE email='$email' ");
		if($check->num_rows > 0){
			$_SESSION['user']=$email;
			header("Location:index.php");


	}else{
		$admin=$conn->query("SELECT * FROM admin WHERE email='$email'");
		if($admin->num_rows>0){
		$_SESSION['user']=$email;
		header("Location:admin.php");

		}
	}


}


?>
<body style="background-color:rgb(242, 242, 242)">
<br><br><br><br><br><br><br><br>
	<div class="container"  style="height: 600px;">
		<div class="row" >
			<div class="col-md-4"></div>

			<div class="col-md-4" style="background-color: #e6e6e6;border-radius: 10px;">
			<img src="images/yves.jpg" style="height: 160px;width: 160px;margin-top: -90px;margin-left: 30%;" class="img-circle img-responsible">
			<h3><center>Login!</center></h3>
				<form class="form" style="" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" >
				<br><br><label class="text-danger"><?php echo $unknown;?></label>
					<div class="form-group">
						<label>E-mail\Username:</label>
						<input type="text" name="email" class="form-control" placeholder="E-mail or Username" />
					</div>
					<div class="form-group">
						<label>Password:</label>
						<input type="password" name="pass" class="form-control" placeholder="Password" />
					</div>
					<div class="form-group">
						<input type="checkbox" name="remember" ><label>Remember Me !</label>
						<input type="submit" value="Login" name="login" class="form-control btn btn-success" />

					</div>
					<a href="forget.php">Forget Password !</a>
					<a href="signup.php" class="pull-right">Create Account !</a>
					<br><br>
				</form>
			</div>
		</div>
	</div>

<?php
include'footer.php'
?>
</body>