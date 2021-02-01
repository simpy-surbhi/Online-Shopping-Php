<?php
include'db/conn.php';
if(isset($_POST['id'])){
	$id=$_POST['id'];
	$fetch=$conn->query("select * from products where id='$id' ");
	while($data=$fetch->fetch_assoc()){
		
		$output='
		<p><img src="'.$data['image'].'" class="img-responsive img-thumbnail" /></p>
		<p><label> Name: '.$data['title'].'</label></p>
		<p><label> Price: '.$data['price'].'</label></p>
		<p><label> Description: '.$data['description'].'</label></p>
		

		';
		
	}
	
echo $output;
}
?>