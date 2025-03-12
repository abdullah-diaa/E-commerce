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

<link rel="stylesheet" href="style.css"/>              
 <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oleo+Script+Swash+Caps:wght@700&display=swap" rel="stylesheet">

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Domine&display=swap" rel="stylesheet">
<link href="shake.css" rel="stylesheet">
<style>

body{

background-color:lightblue;
}


.label_font{

width:140px;
height:30px;
color:yellow;
font-weight:bold;
border:2px solid black;
background:red;
padding:5px ;
text-align:center;
}

.inp_style{

width:auto;
border:2px solid black;

background:yellow;
}

.link-style{
font-weight:bold;
border:2px solid black;
-webkit-text-stroke: 0.12px black;
}

.nav-mar{
width:200px;
text-align:start;


}

.name-font{

font-family: 'Oleo Script Swash Caps', cursive;
}



.cont_font{


font-family: 'Domine', serif;
}



.main-style{
margin-top:220px !important;
width:100%;
height:auto !important;

text-align:center;
}

.mr-b{
margin-bottom:400px !important;

}

.tool_icon{

width:8%;
height:8%;


}
.table_style{


border:2px solid red;
background:white;

width:90%;
margin-left:5%;
}

.table_style th{
text-align:center;

}

.alert-text{

width:90% !important;

margin:auto;
margin-bottom:20px;
}

</style>
          </head>
          
          
      <body>
<?php  
require_once "nav.php";
?>
<main class="main-style mr-b">

<?php


error_reporting(0); ini_set('display_errors', 0);

session_start();
if(isset($_SESSION['user'])){
if($_SESSION['user']->role ==='boss'){


require_once "../connectdatabase.php";

$get_cat =$conn->prepare("SELECT * FROM category");

if($get_cat->execute()){
echo '<table class="table table-striped table_style mr-b cont_font">

<tr> <th><label class="label_font"> Category Name </label> </th>

<th><label class="label_font"> Update </label></th>
<th> <label class="label_font">Delete </label></th>
     </tr>

';




foreach($get_cat AS $data){


echo '<form  method="GET">
<tr> <th>
<input class="inp_style" type="text" value="'.$data['c_name'].'" name="cat_name" />
</th>
<th>
<button  class="btn btn-success" value="'.$data['c_id'].'" type="submit" name="update_cat"> Update </button>
</th>
 </form><form method="POST">
 <th>
 <button class="btn btn-danger" value="'.$data['c_id'].'" name="delete_cat">Delete</button></th></tr></form>';
 
 }

echo '</table>  
<a href="add_category.php" class="mr-b"><img src="img/back_icon.png" class="tool_icon shake "/></a><br> <br><br>';


if(isset($_GET['update_cat'])){

$cat_name=$_GET['cat_name'];
$cat_id = $_GET['update_cat'];

$update_category =$conn->prepare("UPDATE category SET c_name =:c_name WHERE c_id =:c_id");
$update_category->bindParam("c_name",$cat_name);

$update_category->bindParam("c_id",$cat_id);

if($update_category->execute()){

echo '<div class="alert alert-success alert-text">
The category has been successfully updated
 </div>';
echo '<script>
setTimeout(function(){
            window.location.href ="http://localhost:8080/website/boss/edit_category.php"
         }, 2000); </script>';



}else{

echo '<div class="alert alert-danger alert-text">
There is something wrong
 </div>';

echo '<script>
setTimeout(function(){
            window.location.href ="http://localhost:8080/website/boss/edit_category.php"
         }, 2000); </script>';


}}

if(isset($_POST['delete_cat'])){

$get_pro =$conn->prepare("SELECT * FROM add_product WHERE p_category =:p_category");
$get_pro->bindParam("p_category",$_POST['delete_cat']);

$get_pro->execute();


foreach($get_pro AS $get_pro_data){

$drop_foreing_vid=$conn->prepare("ALTER TABLE video
DROP FOREIGN KEY `video_ibfk_1`");

$delet_vid = $conn->prepare("DELETE FROM video WHERE pro_id =:pro_id");

$delet_vid->bindParam("pro_id",$get_pro_data['p_id']);
$delet_vid->execute();

$drop_foreing_customer=$conn->prepare("ALTER TABLE customer
DROP FOREIGN KEY `customer_ibfk_1`");

$delet_cus = $conn->prepare("DELETE FROM customer WHERE pro_id =:pro_id");

$delet_cus->bindparam("pro_id",$get_pro_data['p_id']);
$delet_cus->execute();
$drop_foreign_pro=$conn->prepare("ALTER TABLE add_product
DROP FOREIGN KEY `add_product_ibfk_1`");


$delete_pro = $conn->prepare("DELETE FROM add_product WHERE p_category =:p_category");

$delete_pro->bindParam("p_category",$_POST['delete_cat']);

$delete_pro->execute();
}
 

$delete_cat = $conn->prepare("DELETE FROM category WHERE c_id =:c_id");




$delete_cat->bindParam("c_id",$_POST['delete_cat']);

if($delete_cat->execute()){



echo '<div class="alert alert-success alert-text">
The category has been successfully deleted


 </div>';
 
 echo '<script>
setTimeout(function(){
            window.location.href ="http://localhost:8080/website/boss/edit_category.php"
         }, 2000); </script>';

$add_foreign_key =$conn->prepare("ALTER TABLE `add_product` ADD CONSTRAINT `add_product_ibfk_1` FOREIGN KEY (`p_category`) REFERENCES `category`(`c_id`) ON DELETE CASCADE ON UPDATE CASCADE");

$add_foreign_key_vid =$conn->prepare("ALTER TABLE `video` ADD CONSTRAINT `vidoe_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `add_product`(`p_id`) ON DELETE CASCADE ON UPDATE CASCADE");


$add_foreign_key_cus =$conn->prepare("ALTER TABLE `customer` ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `add_product`(`p_id`) ON DELETE CASCADE ON UPDATE CASCADE");

}else{

$add_foreign_key =$conn->prepare("ALTER TABLE `add_product` ADD CONSTRAINT `add_product_ibfk_1` FOREIGN KEY (`p_category`) REFERENCES `category`(`c_id`) ON DELETE CASCADE ON UPDATE CASCADE");

$add_foreign_key_vid =$conn->prepare("ALTER TABLE `video` ADD CONSTRAINT `vidoe_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `add_product`(`p_id`) ON DELETE CASCADE ON UPDATE CASCADE");

$add_foreign_key_cus =$conn->prepare("ALTER TABLE `customer` ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `add_product`(`p_id`) ON DELETE CASCADE ON UPDATE CASCADE");


}



















}








}



}

else{

session_unset();
session_destroy();
header("location:http://localhost:8080/website/login.php",true);


}
}else{

session_unset();
session_destroy();
header("location:http://localhost:8080/website/login.php",true);

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