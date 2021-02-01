<?php

include'db/conn.php';
include"header.php";
?>
<br><br><br><br>
<div class="container">
  <ul class="nav nav-tabs">
    <li ><a href="products.php">Product Details</a></li>
    <li class="active"><a href="related.php">Related Products</a></li>
  </ul>
</div><br><br>
<div class="container">
<?php
$relate=substr($_SESSION['name'], 0,3);
$price=substr($_SESSION['price'], 0,5);
$futered=$conn->query("SELECT * FROM products where title like '%$relate%' or price like '%$price%'");
while($f_products=$futered->fetch_assoc())
{
?>
            <div class="span3 col-md-3">
                <div class="thumbnail" style="width: 280px;height: 390px;">
                    <a class="hover" id="<?= $f_products['id']?>"><img src="<?= $f_products['image']?>" style="width:70%;height: 190px;"></a>
                    <div class="caption">
                         <h4>Name :<?= $f_products['title']?></h4>
                         <h4>Price :<span  class="text-danger" style="text-decoration: line-through;"><?= " $". $f_products['list_price']?></span><?= " $". $f_products['price']?></h4>
                            <p><?=$f_products['description']?></p>
                            <div class="downbutton">
                            <a class="btn btn-success down" href="cart.php?add=<?=
                            $f_products['id']?>">Add to <i class="fa fa-shopping-cart" ></i></a>
                            <a class="btn btn-primary down" href="#"><?= " $". $f_products['price']?><i ></i></a>
                            <a class="btn btn-primary down" href="products.php?action=details&id=<?=
                            $f_products['id']?>">Details <i ></i></a>
                            </div>
                    </div>
                </div>
            </div>
<?php
}
?>
</div>
<?php
include'footer.php'

?>