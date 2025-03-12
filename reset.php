<!DOCTYPE html>
  <html>
   
    <head>
    
    
           <title>
           
                    Website </title>
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


.main-style{
margin-top:200px !important;
width:100%;
height:700px !important;


}
.name-font{

font-family: 'Oleo Script Swash Caps', cursive;
}

.cont_font{


font-family: 'Domine', serif;
}



.inp_style{

border:2px solid black;

background:yellow;}


.label_font{
width:140px;
height:40px;
color:yellow;
font-weight:bold;
border:2px solid black;
background:red;

padding:5px;
text-align:center;
margin:0px;
}


.cont_font{

font-family: 'Domine', serif;


}

.mr-l{


margin-left:250px;
}





.mr-b{

margin-bottom:150px;
}

.link-style{
font-weight:bold;
border:2px solid black;
-webkit-text-stroke: 0.2px black;
color:white;
}


.position_style{

position:absolute;
left:35%;
width:30%;

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
 <main class="container mt-5 cont main-style">
<?php

error_reporting(0); ini_set('display_errors', 0);

if(!isset($_GET['code'])){
echo '<form method="POST" class="mr-b">
<p class="label_font cont_font">
Your &nbsp; E_mail :</p><input id="email" class="form-control inp_style" required type="email" name="email" /> <br> <br>
<button class="btn btn-success cont_font link-style" "type="submit" name="resetPass"> Get a url to reset your password </button></form>';

echo '<a href="login.php" class="cont_font  link-style btn btn-primary" >Sign In  </a>

<a href="register.php" class="cont_font link-style mr-l btn btn-danger">Sign Up</a>

';





}


else if(isset($_GET['code']) && isset($_GET['email'])){

require_once "connectdatabase.php";
$get_scurtity_code=$conn->prepare("SELECT * FROM register WHERE email=:email");

$get_scurtity_code->bindParam("email",$_GET['email']);

$get_scurtity_code->execute();


foreach($get_scurtity_code AS $data){



if($data['securitycode']  ==$_GET['code']){




echo '<form method="POST">

<label class="cont_font label_font mb-2"> New Password :</label> <input id="newpass" type="text" name="password" class="form-control inp_style" /> <br>
<button type="submit" name="newpass" class="btn btn-success cont_font link-style position_style"> Repeat password</button></form>';
}else{

header("refresh:0.1;url=http://localhost:8080/website/login.php",true);
}}}

?>

<?php

if(isset($_POST['resetPass'])){

require_once 'connectdatabase.php';

$user= $conn->prepare("SELECT email,securitycode FROM register WHERE email=:email");
$email= $_POST['email'];
$user->bindParam("email",$email);

$user->execute();
if($user->rowCount() >0){

require_once 'mailer.php';

$userdata =$user->fetchObject();

$mail->addAddress($email);
$mail->Subject = 'reset password';

$mail->Body ='<div> reset password <br> </div>'.'<a href="http://localhost:8080/website/reset.php?email='.$email.'&code='.$userdata->securitycode. '">http://localhost:8080/website/reset.php?email='.$email.'&code='.$userdata->securitycode.'</a>';
$mail->setFrom("dyabdallh531@gmail.com","website");




$mail->send();

echo '<div class="alert alert-success mt-5">
Code has been sent .... Check your email';

echo'<script> 

setTimeout(function(){
           window.location="reset.php"; },2000)
     




</script>



 </div> <br>  <br>';








}
else{

echo '<div class="alert alert-danger mt-5">
There is no such email registered on our website
 </div>';






}

}






?>

<?php

if(isset($_POST['newpass'])){
require_once 'connectdatabase.php';



$update_password = $conn->prepare("UPDATE register SET password=:password WHERE email=:email");


$newpassword=$_POST['password'];
$update_password->bindParam("password",$newpassword);
$update_password->bindParam("email",$_GET['email']);

if($update_password->execute()){
$securitycode = md5(date("h:i:s"));
$update_code  =$conn->prepare("UPDATE register SET securitycode =:securitycode WHERE email =:email");

$update_code->bindParam("email",$_GET['email']);

$update_code->bindParam("securitycode",$securitycode);

$update_code->execute();


echo '<div class="alert alert-success mt-5">
Password changed successfully
 </div>';



header("refresh:3;url=http://localhost:8080/website/login.php",true);
}}
else{


"<div class='alert alert-warning'> there is something wrong</div>";



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
        <script>
        
        if( /Android|webOS|iPhone|iPad|iPod|Opera Mini/i.test(navigator.userAgent) ) {var email_focus =document.getElementById('email');
 var newpass =document.getElementById('newpass');
 
 
 var foot =document.getElementById('footer');
 email_focus.addEventListener('focus', (event) => {
 
 foot.style.display="none";
 });
 
 
 newpass.addEventListener('focus', (event) => {
 
 foot.style.display="none";
 });
  email_focus.addEventListener('focusout', (event) => {
 
 foot.style.display="inline";
 });
 
 
 newpass.addEventListener('focusout', (event) => {
 
 foot.style.display="inline";
 });
 
 
 
 }
 
        
        
        
        
      
 
 </script>
        </body>
        
        
     </html>