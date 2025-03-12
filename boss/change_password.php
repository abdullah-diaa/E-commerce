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
background-size:100% 1300px;
background-size:cover
background-attachment:fixed;

}

.mr-t{
margin-top:150px;


}

.main-style{
margin-top:220px !important;
width:100%;
height:860px !important;


}


.name-font{

font-family: 'Oleo Script Swash Caps', cursive;
}


.cont_font{


font-family: 'Domine', serif;
}



.nav-mar{
width:200px;
text-align:start;


}


.label_font{

width:30%;
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

.mr-b{

margin-bottom:200px;


}

.tool_icon{

width:12%;
height:12%;


}
</style>
</head>



<body>
<?php  
require_once "nav.php";
?>

<main class="container mr-b mr-t main-style">
<?php


error_reporting(0); ini_set('display_errors', 0);

session_start();
if(isset($_SESSION['user'])){
if($_SESSION['user']->role ==='boss'){

require_once "../connectdatabase.php";


echo '<form method="POST" class="mr-b">

<label class="label_font">Your password</label> <br> <br>
<input type="text" class="form-control inp_style" name="pass" required/>
<br>
<label class="label_font">New password</label> <br> <br>

<input type="password"  class="form-control inp_style" name="newPass" required />
<br>
<label class="label_font">Confirm your password </label> <br> <br>
<input type="password"  class="form-control inp_style" name="confPass" required/>
<br> <br>
<button class="form-control btn btn-success link-style link-style" name="change_pass"> Change password </button>
</form>';



if(isset($_POST['change_pass'])){

$get_pass =$conn->prepare("SELECT * FROM register WHERE id =:id");



$get_pass->bindParam("id",$_SESSION['user']->id);

$get_pass->execute();

foreach($get_pass AS $data){


if($_POST['pass'] == $data['password']){

if($_POST['newPass'] == $_POST['confPass']){

$update_pass = $conn->prepare("UPDATE register SET password =:password WHERE id =:id");

$update_pass->bindParam("password",$_POST['confPass']);

$update_pass->bindParam("id",$data['id']);


if($update_pass->execute()){

 echo '<div class="alert alert-success">

Password has been updated successfully


 </div>';

echo '<script>
setTimeout(function(){
            window.location.href ="http://localhost:8080/website/boss/change_password.php"
         }, 2000); </script>';

}


}else{


echo '<div class="alert alert-danger">

The new password does not match the confirmation

 </div>';

echo '<script>
setTimeout(function(){
            window.location.href ="http://localhost:8080/website/boss/change_password.php"
         }, 2000); </script>';

}

}else{

echo '<div class="alert alert-danger">

Wrong password

 </div>';


echo '<script>
setTimeout(function(){
            window.location.href ="http://localhost:8080/website/boss/change_password.php"
         }, 2000); </script>';

}


}

}














echo'<a href="index.php"  class="tool_icon float-left"><img src="img/home_icon.png" class="tool_icon shake"/></a></div>';


}

else{

session_unset();
session_destroy();
header("location:http://localhost:8080/website/login.php",true);




}}else{

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
