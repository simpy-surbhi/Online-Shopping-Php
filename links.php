<?php
include"header.php";
include 'db/conn.php';
echo "<br><br><br><br><br>";
$disp=$conn->query("SELECT * FROM users");
echo "<center><h1>Confirmation Links to users for recovering Passwords<h1></center>";
while ($row=$disp->fetch_assoc()) {
	echo $row['id']." ".$row['full_name'] ." -->".$row['forget_password'];
	
	echo "<br>";

}

?>
