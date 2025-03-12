
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


.cards-style{

float:left !important;

max-height:600px;

min-height:600px;

margin-left:15%;
}
.main-style{
margin-top:100px !important;
width:100%;
height:auto !important;
display:inline-block;
text-align:center;
}



.mr-t{


margin-top:150px;
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


.tool_icon{

width:10%;
height:10%;


}
.mr-b{

margin-bottom:100px;

}

.link-style{
font-weight:bold;
border:2px solid black;
-webkit-text-stroke: 0.12px black;


}

.nav-mar{
width:100px;
text-align:start;


}

.name-font{

font-family: 'Oleo Script Swash Caps', cursive;
margin-right:50px;
}


.cont_font{


font-family: 'Domine', serif;
}

</style>



   </head>
          
          
      <body>


<?php  
include_once "nav_pro.php";
?>


<main class="main-style">

<?php


error_reporting(0); ini_set('display_errors', 0);

if(isset($_GET['p_category'])){

$get_category_product =$conn->prepare("SELECT * FROM add_product WHERE p_category= :p_category");

$get_category_product->bindParam("p_category",$_GET['p_category']);

$get_category_product->execute();

if($get_category_product->rowCount() >0){



foreach($get_category_product AS $data){


 
if(isset($_POST['sell'])){
 
session_start();
if(isset($_SESSION['user'])){





 
 
 
 $get_data = $conn->prepare("SELECT * FROM customer WHERE user_id =:user_id AND pro_id=:pro_id");




$get_data->bindParam("user_id",$_SESSION['user']->id);
$get_data->bindParam("pro_id",$_POST['sell']);

  
$get_data->execute();



if($get_data->rowCount() > 0){




}
else{



$ins_data = $conn->prepare("INSERT INTO customer(user_id,pro_id,qty) VALUES (:user_id,:pro_id,1)");

$ins_data->bindParam("user_id",$_SESSION['user']->id);

$ins_data->bindParam("pro_id",$_POST['sell']);

$ins_data->execute();

}



}else{

session_unset();
session_destroy();
header("location:http://localhost:8080/website/login.php",true);


}
 }





echo '<div class="mr-b"><a class="nav-link active link-style btn btn-primary"  aria-current="page" style="float:left; margin-left:20%;margin-top:5%;" href="user/cardd.php">Complete shoping</a>';




echo'<a href="index.php" class="tool_icon"><img src="user/img/home_icon.png" class="tool_icon shake mr-b"/></a></div>';


require_once "connectdatabase.php";








$get_product =$conn->prepare("SELECT * FROM add_product");

$get_product->execute();

if($get_product->rowCount() >0){

echo '<div class="card mt-5 cards-style mr-b" style="width: 18rem;">
  <img style="min-height:200px !important;   max-height:200px !important;" src="user/'.$data['p_img']. '" class="card-img-top" alt="Photo"/>
  
  <div class="card-body">
    <h5 class="card-title cont_font">'.$data['p_name'] .'</h5>
    
  </div>
  <ul class="list-group list-group-light list-group-small">';
 
 $get_vid =$conn->prepare("SELECT * FROM video WHERE pro_id =:pro_id");        
 $get_vid->bindParam("pro_id",$data['p_id']);
$get_vid->execute();

if($get_vid->rowCount() >0){

foreach($get_vid AS $vid){

echo '<li class="list-group-item px-4"><a href="user/video.php?video_code='.$vid['pro_id'].'" > Watch Video </a></li>';



}

}
 

 
  echo   '<li class="list-group-item px-4"><a href="user/product_details.php?pro_detail='.$data['p_id'].'"> detail </a>
    
  
  

    
 
    
    
    
  </ul>
  <div class="card-body" style="position:absolute;top:96%;">';
    
    echo '<form method="POST">  
    <button  class="btn btn-success mt-1" type="submit" name="sell" value="'.$data['p_id'].'">Add to cart  </button></form>';
    
    echo '</a>
   
  </div>
</div>';















   

 
 
 }}







}}


else{
echo '<div class="mr-b"><a class="nav-link active link-style btn btn-primary"  aria-current="page" style="float:left; margin-left:20%;margin-top:5%;" href="user/cardd.php">Complete shoping</a>';




echo'<a href="user/index.php" class="tool_icon"><img src="user/img/home_icon.png" class="tool_icon shake mr-b"/></a></div>';


require_once "connectdatabase.php";

 function getIp(){

$ip =$_SERVER['REMOTE_ADDR'];

if(!empty($_SERVER['HTTP_CLIENT_IP'])){

$ip =$_SERVER['HTTP_CLIENT_IP'];


}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){

$ip =$_SERVER['HTTP_X_FORWARDED_FOR'];

}

return $ip;
}






$get_product =$conn->prepare("SELECT * FROM add_product");

$get_product->execute();

if($get_product->rowCount() >0){



foreach($get_product AS $data){
if(isset($_POST['sell'])){
 
session_start();
if(isset($_SESSION['user'])){













$ip = getIp();

 
 
 
 $get_data = $conn->prepare("SELECT * FROM customer WHERE user_id =:user_id AND pro_id=:pro_id");




$get_data->bindParam("user_id",$_SESSION['user']->id);
$get_data->bindParam("pro_id",$_POST['sell']);

  
$get_data->execute();



if($get_data->rowCount() > 0){





}
else{



$ins_data = $conn->prepare("INSERT INTO customer(user_id,pro_id,qty) VALUES (:user_id,:pro_id,1)");

$ins_data->bindParam("user_id",$_SESSION['user']->id);

$ins_data->bindParam("pro_id",$_POST['sell']);

$ins_data->execute();

}




}else{

session_unset();
session_destroy();
header("location:http://localhost:8080/website/login.php",true);


}




}





echo '<div class="card mt-5 cards-style mr-b" style="width: 18rem;">
  <img style="min-height:200px !important;   max-height:200px !important;" src="user/'.$data['p_img']. '" class="card-img-top" alt="Photo"/>
  
  <div class="card-body">
    <h5 class="card-title cont_font">'.$data['p_name'] .'</h5>
    
  </div>
  <ul class="list-group list-group-light list-group-small">';
 
 $get_vid =$conn->prepare("SELECT * FROM video WHERE pro_id =:pro_id");        
 $get_vid->bindParam("pro_id",$data['p_id']);
$get_vid->execute();

if($get_vid->rowCount() >0){

foreach($get_vid AS $vid){



echo '<li class="list-group-item px-4"><a href="user/video.php?video_code='.$vid['pro_id'].'" > Watch Video </a></li>';

}

}
 

 
  echo   '<li class="list-group-item px-4"><a href="user/product_details.php?pro_detail='.$data['p_id'].'"> detail </a>
    
  
  
  

    
    
 <li class="list-group-item px-4"> <h3><a class="cont_font" style="text-decoration:none;color:black;">'.$data['p_price'].'$</h3></a> </li>  
     
    
    
    
  </ul>
  <div class="card-body" style="style="position:absolute;top:96%;">';
    
    echo '<form method="POST" class="mt-1">  
    <button  class="btn btn-success mt-1" type="submit" name="sell" value="'.$data['p_id'].'">Add to cart  </button></form>';
    
    echo '</a>
   
  </div>
</div>';















   

 





}
 }}
 
 
 
    
    
    
   
    



?>






</main>
<?php  
require_once "footer.php";
?>
 


<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"
></script>



</body>
         </html>

