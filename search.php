<?php
include 'db/conn.php';

 
//Getting value of "search" variable from "script.js".
 
if (isset($_POST['search'])) {
 
//Search box value assigning to $Name variable.
 
   $Name = $_POST['search'];
 
//Search query.
 
   $Query = "SELECT title FROM products WHERE title LIKE '%$Name%' LIMIT 5";
 
//Query execution
 
   $ExecQuery = $conn->query($Query);
 
//Creating unordered list to display result.
 
   echo '
 
<ul>
 
   ';
 
   //Fetching result from database.
 
   while ($Result =$ExecQuery->fetch_assoc()) {
 
       ?>
 
   <!-- Creating unordered list items.
 
        Calling javascript function named as "fill" found in "script.js" file.
 
        By passing fetched result as parameter. -->
 
   <li onclick='fill("<?php echo $Result['title']; ?>")' class="list_search" style="border:0px solid blue;height:28px;">
 
   <a class="search">
 
   <!-- Assigning searched result in "Search box" in "search.php" file. -->
 
       <?php echo $Result['title']; ?>
 
   </li></a>
 
   <!-- Below php code is just for closing parenthesis. Don't be confused. -->
 
   <?php
 
}}
 
 
?>
 
</ul>