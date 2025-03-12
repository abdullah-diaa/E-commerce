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
height:1300px !important;


}




.tool_icon{

width:14%;
height:10%;


}

.mr-l{


margin-left:300px;

}

.mr-b{
margin-bottom:200px;

}




.alert-text{

transform: translate(20%, 75vh);
width:75% !important;
}
</style>
          </head>
          
          
      <body>
<?php  
require_once "nav.php";
?>

  <?php
error_reporting(0); ini_set('display_errors', 0);
  
  
  
require_once "../connectdatabase.php";
session_start();
if(isset($_SESSION['user'])){
if($_SESSION['user']->role ==='boss'){




if(isset($_POST['add_product'])){



$file_name= $_FILES["p_img"]["name"];

$file_tmp = $_FILES["p_img"]["tmp_name"];

 $move = move_uploaded_file($file_tmp,"picture/".$file_name);





$add_item = $conn->prepare("INSERT INTO add_product(p_name,p_img,p_price,p_describe,p_category,p_status) VALUES (:p_name,:p_img,:p_price,:p_describe,:p_category,:p_status)");

$p_name= $_POST['p_name'];

$add_file_name= "picture/". $_FILES["p_img"]["name"];


$p_price= $_POST['p_price'];
$p_describe= $_POST['p_describe'];
$p_category= $_POST['p_category'];
$p_status= $_POST['p_status'];

$add_item->bindParam("p_name",$p_name);

$add_item->bindParam("p_img",$add_file_name);

$add_item->bindParam("p_price",$p_price);

$add_item->bindParam("p_describe",$p_describe);

$add_item->bindParam("p_category",$p_category);

$add_item->bindParam("p_status",$p_status);



if($add_item->execute()){

echo "<div class='alert alert-success alert-text'> Add product had been successfuly... </div>";



header("refresh:2;url=http://localhost:8080/website/boss/add_item.php",true);

}else{


echo "<div class='alert alert-danger alert-text'> There is something wrong </div>";


header("refresh:5;url=http://localhost:8080/website/boss/add_item.php",true);



}

}


}else{

session_unset();
session_destroy();
header("location:http://localhost:8080/website/login.php",true);


}  } else{

session_unset();
session_destroy();
header("location:http://localhost:8080/website/login.php",true);


}


?>
<main  class="container main-style mr-b">


<form method="POST" enctype="multipart/form-data" style="margin-bottom:100px;">


<label class="label_font" > Product_Name:  </label>
<br><br>
<input class="form-control inp_style" type="text" name="p_name"  required/>

<br> <br> <br>
<select name="p_category" style="width:30%;" class="inp_style" required>

<option value="" selected>Category </option>
<?php
require_once "../connectdatabase.php";

$select_category =$conn->prepare("SELECT * FROM category");

$select_category->execute();

foreach($select_category AS $data){

echo  
'<option value="'.$data['c_id'].
'">'.$data['c_name'].   '</option>';


}

?>
</select>


<br><br><br>

<br>
<label class="label_font"> Product_Price: </label><br><br>
<input class="form-control inp_style" type="number" name="p_price" required/>
<br> <br><br>

<label class="label_font"> Product_Describe: </label><br><br>
<textarea class="inp_style"   rows="5" cols="75" name="p_describe" required>

</textarea>


<br><br><br>

<select name="p_status" style="width:30%;" class="inp_style" required>
<option  selected value=""> Status</option>

<option  value="yes"> Available</option>

<option   value="no"> Available soon</option>



</select>
<br>
<br> <br> <br>

<label  class="label_font"> Product_img: </label><br>
<br/> 
<input class=" inp_style" type="file" name="p_img" required /><br> <br> <br>
<button type="submit" class="btn btn-success form-control link-style" name="add_product">  Post </button>

</form>

<?php
 echo '<a href="index.php" style="margin-bottom:200px;" ><img src="img/Home_icon.png" class="tool_icon shake"/></a>';
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