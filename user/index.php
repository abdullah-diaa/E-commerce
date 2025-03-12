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
background-size:100% 2000px;

background-attachment:fixed;

}

.main-style{
margin-top:170px !important;
width:100%;
height:1400px !important;


}





.tool_icon{

width:12%;
height:8%;


}


.tool_icon:hover{

width:20%;
height:20%;


}
.add_item{
width:9%;
height:10%;

}
.add_item:hover{
width:17%;
height:20%;

}

.mr-l{
margin-left:30%;




}

.mr-b{

margin-bottom:30% !important;

}


.label_font{

font-family: 'Domine', serif;
color:red;
background:yellow;
}



.label_font:hover{

font-family: 'Domine', serif;
color:yellow;
background:red;

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

.change_pass_icon{


width:12%;
height:8%;

}

.change_pass_icon:hover{


width:18%;
height:12%;

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

  if( empty(session_id()) && !headers_sent()){ session_start(); }
  
if(isset($_SESSION['user'])){

if($_SESSION['user']->role === "user"){


echo '<h1 class="mb-5" style="font-family: Domine, serif;
color:yellow;-webkit-text-stroke: 1px black; background:red; width:350px; margin-bottom:80px !important"> Hi   ' . $_SESSION['user']->name .'</h1> <br>';

echo '<div class="mr-b"> <a  href="profile.php" > <img src="img/profile_icon.png" class="tool_icon shake" /><label class="label_font" >Edit profile </label></a>';

echo '<a href="productt.php" style="margin-bottom:100px;" class="mr-l"> <img src="img/prod-icon.webp" class="tool_icon shake"/> <label class="label_font" >Products </label></a></div>';




echo '<a style="margin-top:30% !important;"  href="change_password.php"  class="mr-b"><img src="img/security_icon.png" class="change_pass_icon shake"/><label class="label_font">Change password </label></a>';



echo '<form method="GET" style="margin-top:80px;">
<button class="btn btn-danger mt-5" type="submit" name="log_out" style="margin-bottom:20px;"> Log_out</button>

</form>';

if(isset($_GET['log_out'])){
session_unset();
session_destroy();

echo 
 
'<script> 

setTimeout(function(){
           window.location="../login.php"; },200)
     




</script>';
}


}else{

'<script> 

setTimeout(function(){
           window.location="../login.php"; },200)
     




</script>';

die("");
}




}else{
'<script> 

setTimeout(function(){
           window.location="../login.php"; },200)
     




</script>';
die("");

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