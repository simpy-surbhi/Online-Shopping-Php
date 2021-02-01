<?php
$total_price=0;
$total_tax=0;
$total_discount=0;
include'db/conn.php';
include"header.php";
if(!isset($_SESSION['user'])){
 header("location:login.php");
}

$image="";
$id_user="";
$id_products="";
session_start();
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
if(isset($_GET['add'])){
	
	$id=$_GET['add'];
	$check_users=$conn->query("SELECT * from users where email='$user' ");
	if($check_users->num_rows>0){
		while($row=$check_users->fetch_assoc()){
			
			$id_user=$row['id'];
		}
	}
	$check_products=$conn->query("SELECT * from products where id='$id' ");
	if($check_products->num_rows>0){
		while($row=$check_products->fetch_assoc()){
			$image=$row['image'];
			$id_products=$row['id'];
			
		}
	}
	$chech_if_exist=$conn->query("SELECT * from cart where id_from_products='$id_products'") or die("can't check");
	if($chech_if_exist->num_rows==0){
		$insert=$conn->query("INSERT INTO cart (id_from_user,image,id_from_products) values ('$id_user','$image','$id_products')");
	if($insert===FALSE){
		echo "Sorry mhn";
		}
	}
	
	header("location:cart.php");
	$result=$conn->query("SELECT users.id,cart.id_from_user,cart.id_from_products,cart.image,products.description,products.title,
		products.price,products.discount,products.tax from users 
		INNER JOIN cart ON cart.id_from_user=users.id 
		INNER JOIN products ON products.id=cart.id_from_products where users.email='$user'");


}

	$result=$conn->query("SELECT products.title,users.id,cart.id,cart.id_from_user,cart.id_from_products,cart.image,products.description,
		products.price,products.discount,products.tax from users 
		INNER JOIN cart ON cart.id_from_user=users.id 
		INNER JOIN products ON products.id=cart.id_from_products where users.email='$user'");
	

	//this where we are going to put our delete statements

	if(isset($_GET['option'])){
		if($_GET['option']=="delete"){
			$id_to_delete=$_GET['id'];
			$delete=$conn->query("DELETE FROM cart WHERE id='$id_to_delete'");
			if($delete===TRUE){
				echo "<script>alert('Sucessfully deleted')</script>";
				header("location:cart.php");
			}
		}
	}

?>
<body>

	<div class="container">
		<div class="row">
			<div class="col-md-1 hidden-xs hidden-sm"  style="height: 700px;"></div>
			<div class="col-md-10">
			<h3>SHOPPING CART [ <?php echo $result->num_rows; ?> ]<span class="pull-right"><a href="index.php#home" class="btn btn-primary"><-- Continue Shopping !</a></span></h3><br><br>
				<table class="table table-bordered table-responsive">
					<thead>
						<tr >
							<th>Product</th>
							<th>Name of the products</th>
							<th>Quantity/Update</th>
							<th>Price</th>
							<th>Discount</th>
							<th>Tax</th>
							<th>Total</th>
						</tr>

					</thead>
					<tbody>
<?php
if(isset($result)){
		while ($cart_products=$result->fetch_assoc()) {
			
		$total_price=$cart_products['price']+$total_price;
		$total_discount=$cart_products['discount']+$total_discount;
		$total_tax=$cart_products['tax']+$total_tax;

?>

						<tr>
							<td><img src="<?php echo $cart_products['image'];?>" style="height: 60px; width:60px"></td>
							<td><?php echo $cart_products['title'];?></td>
							<td ><div class="btn-group" style="width: 100%;">
								<input type="number" min="1" id="quantity" value="1" name="quanrirty" class="btn btn-default" style="width: 60px;" />
								<a  onclick="return confirm(' Do you want to delete this from cart ?')" href="cart.php?option=delete&id=<?php echo $cart_products['id'];?>" class="btn btn-danger"><i class="fa fa-close"></i></a>
								<input type="image" class="btn" name="submit"
    src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
    alt="Pay now">
							</div></td>
							<td>$<?php echo $cart_products['price'];?></td>
							<td>$<?php echo $cart_products['discount'];?></td>
							<td>$<?php echo $cart_products['tax'];?></td>
							<td><p id="check"><?php echo "$". $full_total=$cart_products['price']+$cart_products['discount']+$cart_products['tax'];?></p></td>
						</tr><!-- End of table row-->

<?php

}
}
?>
						<tr style="background-color: skyblue">
							<td colspan="6"><h5 class="pull-right">Total Price:</h5></td>
							<td><span>$<?php echo $total_price;?></span></td>
						</tr>
						<tr style="background-color: cyan">													<td colspan="6"><h5 class="pull-right">Total Discount: </h5></td>
							<td><span>$<?php echo $total_discount;?></span></td>
						</tr>
						<tr style="background-color: lightblue">

							<td colspan="6"><h5 class="pull-right">Total Tax:</h5></td>
							<td><span>$<?php echo $total_tax?></span></td>
						</tr>
						<tr>
							<td colspan="6" style="background-color: orange"><h5 class="pull-right">TOTAL(price+tax+discount):</h5></td>
							<td style="background-color: skyblue;"><h5><?php echo "$ ". $total=$total_discount+$total_tax+$total_price;;?></h5></td>
						</tr>
					</tbody>					
				</table>
			</div>
		</div>
	</div>


</body>
<script>
	$(function(){
		var qty=$("#quantity").val();
		$("#add").click(function(){ 
			sum=qty++;

			$("#quantity").val(sum);
			
		});
		$("#decrease").click(function(){
			
			dec=qty--;
			if(dec<0){
			
			
		      }else{
		      	$("#quantity").val(dec);
		      }
		      
		});
	})
</script>


<?php
include"footer.php";
?>