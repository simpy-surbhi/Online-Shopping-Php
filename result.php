<?php
include"db/conn.php";
include"header.php";



?>
<br><br><br>
<div class="row">
    <div class="col-md-4">
        <form class="navbar-form" role="search pull-right" method="POST" action="result.php">
                        <div class="input-group add-on ">
                          <input class="form-control" id="search" placeholder="Search" name="product" id="srch-term" type="text" >
                          
                          <div class="input-group-btn">
                            <button class="btn btn-default" name="serach_btn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                          </div>
                          </div><div id="display" class="span3" style="width: 200px;box-shadow: 0px 0px 0px 0px #ccc;border-radius: 5px 1px 1px 5px;"></div>
                        
                        
                            
                        
                </form>
    </div>
</div>
<div class="container-fluid">
	


<?php 

if(isset($_POST['product'])){
	$product=$_POST['product'];
	$result=$conn->query("SELECT * FROM products where title LIKE '$product%' ");
	if($result->num_rows>0){
		while($row=$result->fetch_assoc()){

?>

<!--Html fronts goes here -->

                <div class="col-md-3 col-sm-5 col-lg-3 col-xs-7">
                    <div class="thumbnail" style="width: 290px;height: 380px;">
                        <a href="products.php?action=details&id=<?= $row['id']?>"><img src="<?= $row['image']?>" style="width:60%;height: 150px;"></a>
                        <div class="caption">
                             <h4>Name :<?= $row['title']?></h4>
                         <h4>Price :<span  class="text-danger" style="text-decoration: line-through;"><?= " $". $row['list_price']?></span>
                         <span><?= " $". $row['list_price']?></span></h4>
                            <p><?= $row['description']?></p>
                            <div class="downbutton">
                            <a class="btn btn-success down" href="cart.php?add=<?= $row['id']?>">Add to <i class="fa fa-shopping-cart" ></i></a>
                            <a class="btn btn-primary down" href="#"><?= " $". $row['price']?><i ></i></a>
                            <a class="btn btn-primary down" href="products.php?action=details&id=<?= $row['id']?>">Details <i ></i></a>
                            </div>
                        </div>
                    </div>
                </div>


<?php
		}
	}

}
 ?>
</div>




<?php

include"footer.php";

?>