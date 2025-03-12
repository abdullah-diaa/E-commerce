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

<style>

body{
background-image:url('img/bg2.jpg');
background-repeat:no-repeat;
background-size:100% 1100px;
background-size:cover
background-attachment:fixed;


}


.font-bg{

background-color:red;

}

.name-font{

font-family: 'Oleo Script Swash Caps', cursive;
}


.cont_font{


font-family: 'Domine', serif;
}


.main-style{
margin-top:200px !important;
width:100%;
height:700px !important;


}


.label1_font{

width:130px;
height:40px;
color:yellow;
font-weight:bold;
border:2px solid black;
background:red;
padding:5px ;
text-align:center;
}


.label2_font{
width:160px;
height:40px;
color:yellow;
font-weight:bold;
border:2px solid black;
background:red;

padding:5px;
text-align:center;
}






.inp_style{

border:2px solid black;

background:yellow;


}



.mr-l{


margin-left:40%;
}

.link-style{
font-weight:bold;
border:2px solid black;
-webkit-text-stroke: 0.12px black;
}




.mr-b{

margin-bottom:150px;

}

.nav-mar{
width:200px;
text-align:start;


}
</style>







          </head>
          
          
          
      <body>



<?php  
require_once "nav.php";
?>



<main  class="container mt-5 bg-image cont main-style">

<form method="POST" class="mr-b" >

<h3 class="cont_font label1_font">E_mail:</h3><input   type="email" name="email"  required  class="form-control inp_style"/> <br>

<br>
<h3 class="cont_font label2_font">  Password : </h3> <input  type="password" name="password" required class="form-control inp_style" /> <br>

<br>

<button type="submit" name="log_in" class="btn btn-primary cont_font link-style form-control"> 
Log_in </button>
</form>


<a href="reset.php"  class="cont_font btn btn-success link-style"> Forget password </a>
<a href="register.php" class="cont_font mr-l btn btn-danger link-style" > Sign Up </a>






<?php



if(isset($_POST['log_in'])){

require_once 'connectdatabase.php';

$login= $conn->prepare("SELECT * FROM register WHERE email=:email AND password=:password");

$password=($_POST['password']);
$email = $_POST['email'];

$login->bindParam("email",$email);
$login->bindParam("password",$password);


$login->execute();

if($login->rowCount() ===1){
   
$userdata = $login->fetchObject();
if($userdata->active ==1){
session_start();
   $_SESSION['user'] = $userdata;
if($userdata->role ==="user"){
header("location:user/index.php",true);
}else if($userdata->role ==="admin"){
header("location:admin/index.php",true);
}else if($userdata->role ==="boss"){
header("location:boss/index.php",true);
}}

else{

echo '<div class="alert alert-danger mt-5">This is un activated account we send the  scuritycode to you</div>';


echo 
 
'<script> 

setTimeout(function(){
           window.location="login.php"; },2000)
     




</script>';

}

}else{

echo '<div class="alert alert-danger mt-5">Wrong email or password </div>';

echo 
 
'<script> 

setTimeout(function(){
           window.location="login.php"; },2000)
     




</script>';


}




}






?>
</main>
<div class="c">   </div>
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