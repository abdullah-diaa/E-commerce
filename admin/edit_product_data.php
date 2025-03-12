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

width:150px;
height:40px;
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
margin-top:100px !important;
width:100%;
height:1730px !important;


}




.tool_icon{

width:10%;
height:6%;


}

.mr-l{


margin-left:300px;

}

.mr-b{
margin-bottom:250px;

}




.alert-text{

transform: translate(5%,70vh)

}

.img_style{

width:25% ;
height:8vh !important;
margin-left:100px;
border-radius:20px;

}

</style>
          </head>
          
          
      <body>
<?php  
require_once "nav.php";
?>
<main  class="container main-style">


<?php

error_reporting(0); ini_set('display_errors', 0);


session_start();
if(isset($_SESSION['user'])){
if($_SESSION['user']->role ==='admin'){

if(isset($_POST['edit_product'])){
require_once "../connectdatabase.php";
$p_id =$_GET['product_id_code'];
$p_category = $_POST['p_category'];

$update_p_category=$conn->prepare("ALTER TABLE add_product
DROP FOREIGN KEY `add_product_ibfk_1`");






$add_p_category=$conn->prepare("UPDATE add_product SET p_category =:p_category WHERE p_id =:p_id");

$add_p_category->bindParam("p_category",$p_category);
$add_p_category->bindParam("p_id",$p_id);

$add_p_category->execute();


$add_foreign_key =$conn->prepare("ALTER TABLE `add_product` ADD CONSTRAINT `add_product_ibfk_1` FOREIGN KEY (`p_category`) REFERENCES `category`(`c_id`) ON DELETE CASCADE ON UPDATE CASCADE");




$edit_data = $conn->prepare("UPDATE add_product SET p_name =:p_name , p_img =:p_img,p_price=:p_price,p_describe=:p_describe,p_status=:p_status WHERE p_id =:p_id");



$p_name = $_POST['p_name'];
$p_img = 'picture/'.$_FILES['p_img']['name'];
$p_price = $_POST['p_price'];
$p_describe= $_POST['p_describe'];

$p_status = $_POST['p_status'];


$edit_data->bindParam("p_name",$p_name);
$edit_data->bindParam("p_img",$p_img);
$edit_data->bindParam("p_price",$p_price);
$edit_data->bindParam("p_describe",$p_describe);

$edit_data->bindParam("p_status",$p_status);
$edit_data->bindParam("p_id",$p_id);
if($edit_data->execute()){

echo "<div class='alert alert-success alert-text'> Product data updated successfully </div>";




header("refresh:2;url=http://localhost:8080/website/admin/edit_product_data.php?product_id_code=".$_GET['product_id_code']." ",true);

















}else{


echo "<div class='alert alert-warning Product data updated successfully'> there is something wrong</div>";

}

}


if(isset($_GET['product_id_code'])){
require_once "../connectdatabase.php";


$get_data = $conn->prepare("SELECT * FROM add_product WHERE p_id =:p_id");


$get_data->bindParam("p_id",$_GET['product_id_code']);

$get_data->execute();

if($get_data->rowCount() >0){


foreach($get_data AS $data){



echo '<form method="POST" enctype="multipart/form-data" class="mr-b">


<label  class="label_font"> Product_Name:  </label><br><br>

<input required class="form-control inp_style" type="text" name="p_name" value="'.$data['p_name'].'" />


<br><br><br>

   <select style="width:30%;" required name="p_category" class="inp_style"><option value="">   Category</option>';

$get_category = $conn->prepare("SELECT * FROM category");

$get_category->execute();

foreach($get_category AS $_data)
{

echo '<option value="'.$_data['c_id'].'">'.$_data['c_name'].'</option>';


}



echo '</select>

<br><br><br>


<br>
<label class="label_font"> Product_Price: </label><br><br>
<input required class="form-control inp_style" type="number" value="'.$data['p_price'].'" name="p_price" />
<br><br><br>



<label class="label_font"> Product_Describe: </label>
<br><br>
<textarea class="inp_style"   rows="5" cols="75" name="p_describe" required>' .$data['p_describe'].'</textarea>



<br><br><br>
<br>
<label class="label_font"> Product_Status:  </label>
<br/> <br/>';

if($data['p_status'] == "no"){
echo '<select style="width:30%;" class="inp_style" required name="p_status">
<option   value=""> Status</option>

<option  value="yes"> Available</option>

<option  selected value="no"> Available soon</option>



</select>';
}else if($data['p_status'] == "yes"){
echo 
'<select class="inp_style" required name="p_status">
<option   value=""> Status</option>

<option selected value="yes"> Available</option>

<option   value="no"> Available soon</option>



</select>';



}
echo '<br/> <br/> <br/>

<label class="label_font"> Product_img: </label>
<br/> 
<input required class="inp_style" reuired type="file" name="p_img" accept="img/*"  value="'.$data['p_img'].'"/> 
<img src="'.$data['p_img'].'" class="img_style"/> <br> <br> <br>
<button type="submit" class="btn btn-success form-control" name="edit_product">  Post </button>

</form>';






}


}






}

 echo '<a href="productt.php" class="tool_icon"><img src="img/back_icon.png" class="tool_icon shake mr-b"/></a>';



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