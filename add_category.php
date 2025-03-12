<!DOCTYPE html>

<html>   <head>
             
                <title> </title>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                
                   <!-- Font Awesome -->
   
   
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
  rel="stylesheet"
/>
<!-- Google Fonts -->
<link
  href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap"
  rel="stylesheet"
/>
<!-- MDB -->
<link
  href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css"
  rel="stylesheet"
/>
<link   rel="stylesheet"      href="css/style.css" />
          </head>
          
          
      <body>
<?php  
require_once "nav_pro.php";
?>
<main style="margin-bottom:200px;" class="container">
<form action="add_item.php" method="GET">

<input class="form-control mt-5 mb-5" type="text" name="category_name" />
<button type="submit" class="btn btn-success" name="add_category"> Add Category </button>

</form>

<?php

if(isset($_GET['add_category'])){

require_once "../connectdatabase.php";

$c_name= $_GET['category_name'];

$select_cat = $conn->prepare("SELECT * FROM category WHERE c_name =:c_name");

$select_cat->bindParam("c_name",$c_name);
$select_cat->execute();

if($select_cat->rowCount()>0){

echo "<div class='alert alert-danger'> This category is exsist already </div>";





}else{

$add_cat=$conn->prepare("INSERT INTO category(c_name) VALUES(:c_name)");

$c_name= $_GET['category_name'];
$add_cat->bindParam("c_name",$c_name);

if($add_cat->execute()){

echo "<div class='alert alert-success'> Add category Has been successfuly </div>";

header("location:products.php",true);

}else{

echo "<div class='alert alert-warning'> There is something wrong</div>";



}

}





}





?>
</main>
<?php  
require_once "footer.php";
?>
 
           
           
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"
></script>
        
        </body>
        
        
     </html>