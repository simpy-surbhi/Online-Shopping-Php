<?php
include'db/conn.php';
include"header.php";
session_start();
session_destroy();
if(isset($_COOKIE['email']) && isset($_COOKIE['identity'])){
	$email=$_COOKIE['email'];
	$identity=$_COOKIE['identity'];
	setcookie("email",$email,time()-60*60*30);
	setcookie("identity",$identity,time()-60*60*30);


}
header("Location:login.php");
?>