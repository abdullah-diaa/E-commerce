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



.inp_style{

border:2px solid black;

background:yellow;
}

.label_font{

width:110px;
height:40px;
color:yellow;
font-weight:bold;
border:2px solid black;
background:red;
padding:5px ;
text-align:center;
}



.mr-b{


margin-bottom:100px;

}

.tool_icon{

width:8%;
height:6%;


}


.name-font{

font-family: 'Oleo Script Swash Caps', cursive;
}



.cont_font{


font-family: 'Domine', serif;
}

.mr-t{


margin-top:100px;
}


.link-style{
font-weight:bold;
border:2px solid black;
-webkit-text-stroke: 0.12px black;


}

</style>

   </head>
          
          
      <body>



<?php  
require_once "nav_pro.php";
?>




<main class="container mr-b mr-t">
<?php

error_reporting(0); ini_set('display_errors', 0);


session_start();
if(isset($_SESSION['user'])){
if($_SESSION['user']->role ==='user'){


function getIp(){

$ip =$_SERVER['REMOTE_ADDR'];

if(!empty($_SERVER['HTTP_CLIENT_IP'])){

$ip =$_SERVER['HTTP_CLIENT_IP'];


}else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){

$ip =$_SERVER['HTTP_X_FORWARDED_FOR'];

}

return $ip;
}


$ip = getIp();



if($ip){
require_once "../connectdatabase.php";

$get_email =$conn->prepare("SELECT * FROM register WHERE email =:email");

$get_email->bindParam("email",$_SESSION['user']->email);

if($get_email->execute()){
$get_c_data = $conn->prepare("SELECT * FROM customer WHERE user_id =:user_id");
$get_c_data->bindParam("user_id",$_SESSION['user']->id);

$get_c_data->execute();

foreach($get_c_data AS $cus_data){

$get_pro_data =$conn->prepare("SELECT * FROM add_product WHERE p_id =:p_id");

$get_pro_data->bindParam("p_id",$cus_data['pro_id']);

if($get_pro_data->execute()){

foreach($get_pro_data AS $_data){



echo '<div class="card mt-5 mr-b" style="width: 22rem; margin-left:25%;">
  <img style="min-height:200px !important;   max-height:200px !important;" src="'.$_data['p_img']. '" class="card-img-top" alt="Photo"/>
  
  <div class="card-body">
    <h5 class="card-title cont_font">'.$_data['p_name'] .'</h5>
    
  </div>
  <ul class="list-group list-group-light list-group-small">';
 
 $get_vid =$conn->prepare("SELECT * FROM video WHERE pro_id =:pro_id");        
 $get_vid->bindParam("pro_id",$data['p_id']);
$get_vid->execute();

if($get_vid->rowCount() >0){

foreach($get_vid AS $vid){



echo '<li class="list-group-item px-4"><a href="video.php?video_code='.$vid['pro_id'].'" > Watch Video </a></li>';

}

}
 

 
  echo   '<li class="list-group-item px-4"><a href="product_details.php?pro_detail='.$_data['p_id'].'"> detail </a>
    
  
  
  
 
    
    
 <li class="list-group-item px-4"> <h3><a class="cont_font" style="text-decoration:none;color:black;">'.$_data['p_price'].'$</h3></a> </li>  
     
    
    
    
  </ul>
  <div class="card-body" style="style="position:absolute;top:96%;">';
  
 echo '<form method="POST">';
 $get_quantity =$conn->prepare("SELECT qty FROM customer WHERE user_id =:user_id AND pro_id =:pro_id");
$get_quantity->bindParam("user_id",$_SESSION['user']->id);
$get_quantity->bindParam("pro_id",$_data['p_id']);
$get_quantity->execute();
foreach($get_quantity AS $gty_value){
 
 
echo '

<label  class="label_font"> Quantity</label>
<br> <br>
<input required type="number" class="form-control inp_style" value="'.$gty_value['qty'].'" name="count" /><br>';


echo '<button style="float:left; width:60% !important;" type="submit" class="btn btn-success" name="pro_count" value="'.$_data['p_id'].'">  Update</button></form>'; 
  
   echo '<form method="POST" style="float:right;"> <button type="submit" class="btn btn-danger" name="pro_delete" value ="'.$_data['p_id'].'"> Drop</button>
        
   </form>';
  

   
 echo  '</div>
</div>';

}
if(isset($_POST['pro_count'])){


$update_qty =$conn->prepare("UPDATE customer SET qty =:qty WHERE user_id =:user_id AND pro_id =:pro_id");
$update_qty->bindParam("qty",$_POST['count']);

$update_qty->bindParam("user_id",$_SESSION['user']->id);
$update_qty->bindParam("pro_id",$_POST['pro_count']);
$update_qty->execute();

echo '<script>
setTimeout(function(){
            window.location.href ="http://localhost:8080/website/user/cardd.php"
         }, 500); </script>';



}else if(isset($_POST['pro_delete'])){




$delete_data = $conn->prepare("DELETE  FROM customer WHERE user_id =:user_id AND pro_id =:pro_id");

$delete_data->bindParam("user_id", $_SESSION['user']->id);

$delete_data->bindParam("pro_id",$_POST['pro_delete']);

if($delete_data->execute()){


echo '<script>
setTimeout(function(){
            window.location.href ="http://localhost:8080/website/user/cardd.php"
         }, 500); </script>';





}




}


}




}










}
echo '<table class="table table-striped mt-5 mr-b table_style cont_font">
<tr>
<th>Product_Name</th>
<th>Price</th>
<th>quantity</th>
<th> end price</th
</tr>';



$get_pro_id=$conn->prepare("SELECT * FROM customer WHERE user_id=:user_id");

$get_pro_id->bindParam("user_id",$_SESSION['user']->id);

if($get_pro_id->execute()){

$get_user_email =$conn->prepare("SELECT * FROM register WHERE email =:email");

$get_user_email->bindParam("email",$_SESSION['user']->email);

if($get_user_email->execute()){
foreach($get_pro_id AS $get_pro_data){


$get_product =$conn->prepare("SELECT * FROM add_product WHERE p_id =:p_id");

$get_product->bindParam("p_id",$get_pro_data['pro_id']);

if($get_product->execute()){
foreach($get_product AS $pro_data){



echo '<tr><th>'.$pro_data['p_name'].'</th>

<th>'.$pro_data['p_price'].'</th>

<th>'.$get_pro_data['qty'].'</th>
<th>'
.$pro_data['p_price'] * $get_pro_data['qty'].


 '</th>
</tr>';

}}}}}
echo '<tr> <th>Cost</th><th>';
function total(){

$servername = "127.0.0.1";
  $database = "website"; 
  $username = "root";
   $password = ""; 
   $conn = new PDO("mysql:host=$servername;dbname=$database",$username, $password);
   
  
   $ip = getIp();
   

$getQuantity =$conn->prepare("SELECT * FROM customer WHERE user_id =:user_id");

$getQuantity->bindParam("user_id",$_SESSION['user']->id);
$getQuantity->execute();

$total =0;

foreach($getQuantity AS $getQua){

$getPrice =$conn->prepare("SELECT * FROM add_product WHERE p_id =:p_id");

$getPrice->bindParam("p_id",$getQua['pro_id']);

$getPrice->execute();

foreach($getPrice AS $getPri){

$pro_price =array($getPri['p_price']);

$count_price =array_sum($pro_price);

$qty_count =array($getQua['qty']);
$get_qty_count = array_sum($qty_count);
 $total +=$count_price * $get_qty_count;
 
}


}
return $total;
}
$total_pri = total();
 
echo '<div>'.$total_pri.'$</div>';




echo '</th></tr>

</table>';






echo'<a href="productt.php"  class="tool_icon float-left"><img src="img/back_icon.png" class="tool_icon shake"/></a></div>';



echo '<a href="add_info.php" style="float:right;" class="btn btn-info link-style">Add your information </a>';








}


}}
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
 


<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"
></script>



</body>
         </html>

