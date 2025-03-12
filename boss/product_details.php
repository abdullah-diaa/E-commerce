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



.main-style{
margin-top:150px !important;
width:100%;
height:auto !important;


}



.name-font{

font-family: 'Oleo Script Swash Caps', cursive;
}


.cont_font{


font-family: 'Domine', serif;
}
.label_font{

width:500px;
height:60px;
color:yellow;
font-weight:bold;
border:2px solid black;
background:red;
padding:5px ;
text-align:center;
}


.inp_style{

border:2px solid black;

background:yellow;


}
.mr-b{

margin-bottom:100px;

}


.nav-mar{
width:200px;
text-align:start;


}


.tool_icon{

width:12%;
height:6%;


}
.link-style{
font-weight:bold;
border:2px solid black;
-webkit-text-stroke: 0.12px black;
}



.table_style{


border:2px solid red;




}

.table_style th{

width:35%;
text-align:center;
}

.table_style td{

width:75%;
text-align:center;
border-left: solid 2px red;
font-size:20pt;

}

.pic_style{

width:100%;
height:100%;

}
.cont_font{


font-family: 'Domine', serif;
}
</style>
          </head>
          
          
      <body>










<?php  
require_once "nav.php";
?>
<main   class="container main-style mr-b">



<?php
error_reporting(0); ini_set('display_errors', 0);


session_start();
if(isset($_SESSION['user'])){
if($_SESSION['user']->role ==='boss'){

if(isset($_GET['pro_detail'])){

require_once "../connectdatabase.php";

$get_info = $conn->prepare("SELECT * FROM add_product WHERE p_id = :p_id");

$get_info->bindParam("p_id",$_GET['pro_detail']);

if($get_info->execute()){


foreach($get_info AS $data){

echo'<label class="label_font cont_font"><h1>Details about product</h1></label>';


echo '<table  class="table table-striped mt-5 mr-b table_style cont_font"> <tr>
<th><h4> Product-Name </h4> </th>


<td>'. $data['p_name'] .'</td>
 </tr>';

$get_cat =$conn->prepare("SELECT * FROM category WHERE c_id =:c_id");

$get_cat->bindParam("c_id",$data['p_category']);

if($get_cat->execute()){

foreach($get_cat AS $_data){

echo '<tr> <th><h4> Category</h4></th>

<td>'. $_data['c_name'] .' </td></tr>
';
}
}


echo '<tr> <th><h4> Price </h4> </th>


<td>'. $data['p_price'] .'$ </td> </tr>';


echo '<tr> <th><h4> Describe </h4> </th>

<td>'. $data['p_describe'] .'</td></tr>';


echo '<tr> <th><h4> Status</h4> </th>';

if($data['p_status']=="yes"){



echo '<td>Availabe</td> </tr>';

}else if ($data['p_status'] =="no"){

echo '<td>Availabe soon</td> </tr>';

}
echo '<tr> <th><h4> picture </h4></th>

<td style="height:30vh;"><img src="'.$data['p_img']. '" alt="photo" class="pic_style" /></td></tr></table>';

echo '<a href="productt.php"><img src="img/back_icon.png" class="tool_icon shake mt-5 mr-b"/></a>';


echo '<form method="POST">


<button class="btn btn-danger form-control mt-5 mb-5" name="delete_product">Delete</button>

</form>';


if(isset($_POST['delete_product'])){


$get_pro =$conn->prepare("SELECT * FROM add_product WHERE p_id =:p_id");
$get_pro->bindParam("p_id",$_GET['pro_detail']);

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


$delete_pro = $conn->prepare("DELETE FROM add_product WHERE p_id =:p_id");

$delete_pro->bindParam("p_id",$_GET['pro_detail']);

if($delete_pro->execute()){

echo '<div class="alert alert-success alert-text">
The category has been successfully deleted


 </div>';
 
 echo '<script>
setTimeout(function(){
            window.location.href ="http://localhost:8080/website/boss/productt.php"
         }, 2000); </script>';

$add_foreign_key =$conn->prepare("ALTER TABLE `add_product` ADD CONSTRAINT `add_product_ibfk_1` FOREIGN KEY (`p_category`) REFERENCES `category`(`c_id`) ON DELETE CASCADE ON UPDATE CASCADE");

$add_foreign_key_vid =$conn->prepare("ALTER TABLE `video` ADD CONSTRAINT `vidoe_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `add_product`(`p_id`) ON DELETE CASCADE ON UPDATE CASCADE");


$add_foreign_key_cus =$conn->prepare("ALTER TABLE `customer` ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `add_product`(`p_id`) ON DELETE CASCADE ON UPDATE CASCADE");

}else{

$add_foreign_key =$conn->prepare("ALTER TABLE `add_product` ADD CONSTRAINT `add_product_ibfk_1` FOREIGN KEY (`p_category`) REFERENCES `category`(`c_id`) ON DELETE CASCADE ON UPDATE CASCADE");

$add_foreign_key_vid =$conn->prepare("ALTER TABLE `video` ADD CONSTRAINT `vidoe_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `add_product`(`p_id`) ON DELETE CASCADE ON UPDATE CASCADE");

$add_foreign_key_cus =$conn->prepare("ALTER TABLE `customer` ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `add_product`(`p_id`) ON DELETE CASCADE ON UPDATE CASCADE");


echo '<div class="alert alert-success alert-text">
There is something wrong


 </div>';


 echo '<script>
setTimeout(function(){
            window.location.href ="http://localhost:8080/website/boss/productt.php"
         }, 2000); </script>';
}








}

}





}







}



}











}else{

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






<div class="c"> </div>
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