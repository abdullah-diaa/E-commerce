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
background-image:url('img/bg.jpg');
background-repeat:no-repeat;
background-size:100% 1800px;

background-attachment:fixed;

}


.label_font{

width:130px;
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
margin-top:220px !important;
width:100%;
height:1300px !important;


}

.tool_icon{

width:14%;
height:8%;


}






</style>

          </head>
          
          
      <body>



<?php  
require_once "nav.php";
?>

<main class="container main-style">
<?php

error_reporting(0); ini_set('display_errors', 0);

session_start();
if(isset($_SESSION['user'])){
if($_SESSION['user']->role ==='user'){

echo '<form class="mt-5" style="margin-bottom:300px;" method="GET">


<label  class="label_font cont_font mb-2">Name :</label><input id="nameid" class="form-control inp_style" type="text" name="name" value="'.$_SESSION['user']->name.'" required /> <br> <br> <br>


<label class="label_font cont_font mb-2"> Age : </label><input class="form-control inp_style" type="date" name="age" value="'.$_SESSION['user']->age .'" required />

<br> <br> 
<button class="btn btn-danger mt-5 position-style link-style form-control" type="submit" name="update" value="'.$_SESSION['user']->id .'"> Update</button>


</form>  <a href="index.php" style="margin-bottom:200px;" ><img src="img/Home_icon.png" class="tool_icon shake"/></a>';
if(isset($_GET['update'])){
require_once '../connectdatabase.php';

$updateuserdata = $conn->prepare("UPDATE register SET name=:name,age=:age WHERE id=:id");

$updateuserdata->bindParam("name",$_GET['name']);
$updateuserdata->bindParam("age",$_GET['age']);
$updateuserdata->bindParam("id",$_GET['update']);

if($updateuserdata->execute()){

echo '<div  class="alert alert-success mt-5"> Data has been updated successfully...</div>';

$user = $conn->prepare("SELECT * From register WHERE id=:id");


$user->bindParam("id",$_GET['update']);

if($user->execute()){


$_SESSION['user']= $user->fetchObject();
 echo 
 
'<script> 

setTimeout(function(){
           window.location="profile.php"; },2000)
     




</script>';
}}

else{

echo '<div class="alert alert-danger mt-5">failed to updata data </div>';
}



}}else{

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
<script>


if( /Android|webOS|iPhone|iPad|iPod|Opera Mini/i.test(navigator.userAgent) ) { var nameid =document.getElementById('nameid');
 
 
 var foot =document.getElementById('footer');
 nameid.addEventListener('focus', (event) => {
 
 foot.style.display="none";
 });
 
 nameid.addEventListener('focusout', (event) => {
 
 foot.style.display="inline";
 });
 
 
 
 
 }
 




 
 </script>


</body>
         </html>