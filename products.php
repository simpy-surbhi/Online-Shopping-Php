<?php

include'db/conn.php';
include"header.php";
if(isset($_GET['action'])){
	if($_GET['action']=="details"){
		$id=$_GET['id'];
		$detail=$conn->query("SELECT * FROM products WHERE id='$id'");
		while($details=$detail->fetch_assoc()){
            $_SESSION['id']=$details['id'];
			      $_SESSION['photo'] =$details['image'];
			      $_SESSION['description'] =$details['description'];
			      $_SESSION['price'] =$details['price'];
			      $_SESSION['list_price'] =$details['list_price'];
			      $_SESSION['name'] =$details['title'];
			      $_SESSION['details'] =$details['details'];
			      $_SESSION['total'] ="7";
			      $_SESSION['shipping'] =$details['shipping'];
		}

	}

}
?>
<br /><br /><br /><br />
<body style="background-color: rgb(255, 255, 252)">
<div class="container">
  <ul class="nav nav-tabs">
    <li class="active"><a href="products.php">Product Details</a></li>
    <li><a href="related.php">Related Products</a></li>
  </ul>
</div><br><br>
  <div class="container" style="background-color: white;">
  <br><br>
  	<div class="row">
  		<div class="col-md-1"></div>
  		<div class="col-md-5 well" style="height: 600px;background-color:white;border:2px solid rgb(242, 242, 242)">
  		<br><br>
  			<div class="thumnail" style="height:400px;">
  				<img src="<?php echo $_SESSION['photo'] ;?>" style="width:80%;height:90%;">
  			</div>

  			<hr>
  			<p>Some Other photos if there is</p>
  		</div>
  		
  		<div class="col-md-6" style="height: 700px;">
  			<h2><?php echo $_SESSION['name'] ;?></h2><br><br>
  			<h3><span class="text-danger" style="text-decoration: line-through;"> $<?php echo $_SESSION['list_price'] ;?></span> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span> $<?php echo $_SESSION['price'] ;?></span></h3><br />
  			<p>
  				<?php echo $_SESSION['details'] ?>
  			</p><br>
  			<h4>&nbsp;&nbsp;shipping: $<?php echo $_SESSION['shipping'];?></h4>
  			<div class="btn btn-group">
  				<button class="btn btn-primary"><?php echo $_SESSION['total'];?></button>
  				<button class="btn btn-success">in Stock</button>
  			</div>
  			<br>
  			<form class="form ">
  				<div class="form-group">
  					&nbsp;&nbsp;&nbsp;<input type="number" name="quantity" min="1" max="<?php $_SESSION['total'];?>"
  					style="width: 50px;height: 30px">
  					<a class="btn btn-success " type="submit" href="cart.php?add=<?=$id?>">Add to cart</a>
  				</div>
  			</form>
  			<div class="" style="height: 4px;width:500px;background-color: grey;"></div>
  			<h4>From:</h4>
  			<h4>Seller:</h4>
  			<h4>Powerd by:</h4>
  		</div>
  	</div>
  </div>
<?php
include"footer.php";
?>