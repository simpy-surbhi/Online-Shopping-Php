
<?php
include"db/conn.php";
include"header.php";

?>

<div style="height: 700px;">
        <div class="background-wrap" style=" background-color: #488aff !important;">
            <video id="video-bg-elem" preload="auto" autoplay="true" loop="loop" muted="muted"> 
                <source src=".mp4" type="video/mp4">
                
                Sorry That The Amazing video Background Is Not Supported Please Contact us and tell us which operating system or which browser you use Sorry!
            </video>          
        </div>


        <div class="content ">       
            <h1 class="bounceInDown animated" style="text-transform: capitalize;">IsangeShop.com</h1>
            <p class="slideInLeft animated">Welcome to our online shopping in Rwanda</p>
        </div>

</div>


    <div style="height: 2px;background-color: orange;width: 100%;"></div><br>

    <div class="container" id="home" style="padding-right: 20px;padding-left: 20px;">
        <div class="row">            
            <div class="col-md-4 col-md-offset-8" style=""><!-- slide show -->
                <form class="navbar-form" role="search pull-right" method="POST" action="result.php" style="float: right;">
                        <div class="input-group add-on ">
                          <input class="form-control" id="search" placeholder="Search" name="product" id="srch-term" type="text" autocomplete="0" autosave="0" class="form-control">                          
                            <div class="input-group-btn">
                              <button class="btn btn-default" name="serach_btn" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                          </div>
                          <div id="display" class="span" style="width: 220px;border-radius: 5px 1px 1px 5px;position: absolute;z-index: 1000;background-color: lightgray !important;"></div>          
                            
                        
                </form>
                
            </div>
        </div>
    </div>

    <div class="container" style="padding-left: 20px;border: 0px solid blue;padding-bottom: 40px;background-color: white;">
          <h2  style="color: teal;">Futered Products</h2>
    <div class="container   " style="padding-left: 15px;padding-right: 55px;">
<?php
$futered=$conn->query("SELECT * FROM products where futered=1");
$latest=$conn->query("SELECT * FROM products where futered=0");
$latest_nums=$latest->num_rows;
$futered_nums=$futered->num_rows;
?>        
        
          <div class="col-md-12" style="border:1px solid lightgray;padding-top:10px;padding-bottom:10px;">
            <div class="row" style="margin-bottom: 5px;">
                <span class="pull-right" style="margin-right: 10px;">
                  <div class="btn-group">
                     <button class="btn btn-default"><?= $futered_nums ;?></button> 
                     <button class="btn btn-info">Futered Products</button>
                  </div>
               </span>
             </div>
<?php
$futered=$conn->query("SELECT * FROM products where futered=1 limit 4");

while($f_products=$futered->fetch_assoc())
{
?>
            <div class=" col-md-3 col-sm-5 col-lg-3 col-xs-12" >
                <div class="thumbnail" style="width: 260px;height: 390px;margin-left: 0 !important;">
                    <a class="hover" data-triger="focus" id="<?= $f_products['id']?>"><img src="<?= $f_products['image']?>" style="width:70%;height: 190px;"></a>
                    <div class="caption">
                         <h4>Name :<?= $f_products['title']?></h4>
                         <h4>Price :<span  class="text-danger" style="text-decoration: line-through;"><?= " $". $f_products['list_price']?></span><span> <?php echo "$".$f_products['price'] ?></span></h4><input type="hidden" id="name" name="" value="<?= $f_products['title']?>">
                            <p><?=$f_products['description']?></p>
                            <div class="downbutton">
                            <a class="btn btn-success down" href="cart.php?add=<?=
                            $f_products['id']?>" onclick="var x=document.getElementById('name').value ;return  confirm('Add to Cart '+x); ">Add to <i class="fa fa-shopping-cart" ></i></a>
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
        
    </div>
    <h2 style="color: teal;">Latest Product</h2>

    
                <div class="col-md-12 col-lg-12" style="position: relative;padding-bottom: 50px;">
                  <div class="col-md-12 col-lg-12" style="border:1px solid lightgray;padding-top:10px;padding-bottom:40px;">
                    <div class="row" style="margin-bottom: 5px;"><span class="pull-right" style="margin-right: 10px;"><div class="btn-group">
                       <button class="btn btn-default"><?= $latest_nums ;?></button> 
                       <button class="btn btn-info">Latest Products</button>
                    </div>
                  </div>
<?php
$sql = "SELECT COUNT(*) FROM products";
$result =$conn->query($sql) or trigger_error("SQL", E_USER_ERROR);
$r = $result->fetch_row();
$numrows = $r[0];

// number of rows to show per page
$rowsperpage = 8;
// find out total pages
$totalpages = ceil($numrows / $rowsperpage);

// get the current page or set a default
if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
   // cast var as int
   $currentpage = (int) $_GET['currentpage'];
} else {
   // default page num
   $currentpage = 1;
} // end if

// if current page is greater than total pages...
if ($currentpage > $totalpages) {
   // set current page to last page
   $currentpage = $totalpages;
} // end if
// if current page is less than first page...
if ($currentpage < 1) {
   // set current page to first page
   $currentpage = 1;
} // end if

// the offset of the list, based on current page 
$offset = ($currentpage - 1) * $rowsperpage;

// get the info from the db 
$sql = "SELECT * FROM products where futered=0  LIMIT $offset, $rowsperpage";
$result = $conn->query($sql) or trigger_error("SQL", E_USER_ERROR);

// while there are rows to be fetched...
while ($row = $result->fetch_assoc()) {
?>
            <div class="col-md-3 col-sm-5 col-lg-3 col-xs-7">
                    <div class="thumbnail" style="width: 260px;height: 380px;">
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
} // end while

/******  build the pagination links ******/
// range of num links to show
$range = 3;
?>
<div class="btn-group " style="float: right;position: absolute;bottom: 10px;right: 10px;" >
<?php
// if not on page 1, don't show back links
if ($currentpage > 1) {
   // show << link to go back to page 1
   echo " <a class='links btn btn-default hidden-xs' href='{$_SERVER['PHP_SELF']}?currentpage=1'><<</a> ";
   // get previous page num
   $prevpage = $currentpage - 1;
   // show < link to go back to 1 page
   echo " <a class='links btn btn-default ' href='{$_SERVER['PHP_SELF']}?currentpage=$prevpage'><</a> ";
} // end if 

// loop to show links to range of pages around current page
for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
   // if it's a valid page number...
   if (($x > 0) && ($x <= $totalpages)) {
      // if we're on current page...
      if ($x == $currentpage) {
         // 'highlight' it but don't make a link
         echo " <b class='links btn btn-danger'>$x</b> ";
      // if not current page...
      } else {
         // make it a link
         echo " <a class='links btn btn-default' href='{$_SERVER['PHP_SELF']}?currentpage=$x'>$x</a> ";
      } // end else
   } // end if 
} // end for

// if not on last page, show forward and last page links        
if ($currentpage != $totalpages) {
   // get next page
   $nextpage = $currentpage + 1;
    // echo forward link for next page 
   echo " <a class='links btn btn-default' href='{$_SERVER['PHP_SELF']}?currentpage=$nextpage'>></a> ";
   // echo forward link for lastpage
   echo " <a class='links btn btn-default' href='{$_SERVER['PHP_SELF']}?currentpage=$totalpages'>>></a> ";
} // end if
/****** end build pagination links ******/
?>
</div>

        </div>
            </div>
    </div>
    
        <br>
        <div class="container-fluid" style="margin-top: 30px">  
        </div>
    
    <?php include'footer.php';
    ?>
    
</body>

</html>
<script>
        $(function(){
            $(".hover").hover(function(){

                $(".hover").popover({
                    title:fetchData,
                    html:true,
                    placement:'bottom'
                });
                function fetchData(){
                    var fetch_Data='';
                    var element=$(this);
                    var id=element.attr("id");
                    $.ajax({
                        url:"fetch.php",
                        method:"POST",
                        async:false,
                        data:{id:id},
                        success:function(data){
                            fetch_Data=data;
                        }
                    });
                    return fetch_Data;

                }
            });
        });
    </script>
    <script>
        $(function(){
            $(".x").click(function(){
                $(" .drop").fadeOut("400");
            });
        });
    </script>
    <script>
        
        function fill(Value) {
 
   //Assigning value to "search" div in "search.php" file.
 
   $('#search').val(Value);
 
   //Hiding "display" div in "search.php" file.
 
   $('#display').hide();
 
}
 
$(document).ready(function() {
 
   //On pressing a key on "Search box" in "search.php" file. This function will be called.
 
   $("#search").keyup(function() {
 
       //Assigning search box value to javascript variable named as "name".
 
       var name = $('#search').val();
 
       //Validating, if "name" is empty.
 
       if (name == "") {
 
           //Assigning empty value to "display" div in "search.php" file.
 
           $("#display").html("");
 
       }
 
       //If name is not empty.
 
       else {
 
           //AJAX is called.
 
           $.ajax({
 
               //AJAX type is "Post".
 
               type: "POST",
 
               //Data will be sent to "ajax.php".
 
               url: "search.php",
 
               //Data, that will be sent to "ajax.php".
 
               data: {
 
                   //Assigning value of "name" into "search" variable.
 
                   search: name
 
               },
 
               //If result found, this funtion will be called.
 
               success: function(html) {
 
                   //Assigning result to "display" div in "search.php" file.
 
                   $("#display").html(html).show();
 
               }
 
           });
 
       }
 
   });
 
});
    </script>