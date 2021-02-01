<?php
$conn=new mysqli("localhost","root","","digishop");
if($conn->connect_error){
	echo "can't serve the client Please contact system administrator".$conn->connect_error;
}
?>