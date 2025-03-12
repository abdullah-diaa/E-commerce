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
margin-top:120px !important;
width:100%;
height:700px !important;


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

.inp_style{

border:2px solid black;

background:yellow;}

.label_font{
width:100px;
height:30px;
color:yellow;
font-weight:bold;
border:2px solid black;
background:red;

padding:5px;
text-align:center;

}

.link-style{
font-weight:bold;
border:2px solid black;
-webkit-text-stroke: 0.2px black;
color:white;
}
.mr-l{


margin-left:300px;
}


.mr-b{

margin-bottom:100px;

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
    
 <form method="POST" class="mr-b"><label class="label_font cont_font" >
NAME:</label><input id="name" class="form-control inp_style" type="text" name="name" required/> <br/>


<label class="label_font cont_font" > Email: </label><input id="email" class="form-control inp_style" type="email" name="email" required /><br/>
 
<label class="label_font cont_font" > Age:</label><input  class="form-control inp_style" type="date" name="age" required /> <br/> 
       
<label class="label_font cont_font" >Password:</label><input id="password" class="form-control inp_style"  type="password" name="password" required />  <br/>  
 
 <button  style="margin-right:20px;" class="btn btn-danger link-style form-control"  type="submit" name ="but1">Log-up</button>     
 </form>
 
 <a href="reset.php"  class="cont_font btn btn-success link-style"> Forget password </a>
 
 <a href="login.php" class="link-style btn btn-primary mr-l" > Sign In </a>
 
  
  
  <?php
  
  error_reporting(0); ini_set('display_errors', 0);
  
 require_once 'connectdatabase.php';
 
 if(isset($_POST['but1'])){
 
 $checkemail = $conn->prepare("SELECT * FROM register WHERE email = :email");
 $email =$_POST['email'];
 $checkemail->bindParam("email",$email);
 $checkemail->execute();
 
 if($checkemail->rowCount() >0){
 
 echo '<div class="alert alert-warning"> This is a used account </div>';
 
 
 
 }else{
 
 $name = $_POST['name'];
 $email =$_POST['email'];
 $age = $_POST['age'];
 $password = ($_POST['password']);
 $securitycode = md5(date("h:i:s"));
 
 $addUser = $conn->prepare("INSERT INTO register(name,email,age,password,securitycode,role) VALUES(:name,:email,:age,:password,:securitycode,'user')");
 
$addUser->bindParam("name",$name);
$addUser->bindParam("email",$email);
$addUser->bindParam("age",$age);
$addUser->bindParam("password",$password);
$addUser->bindParam("securitycode",$securitycode);

if($addUser->execute()){


require_once 'mailer.php';    $mail->setFrom('example@example.com', 'Shopfire');
     $mail->addAddress($email);               //Name is optional
    
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'confirm your account';
    $mail->Body   = '<h1> confirm your account </h1>' . "<div>
THANK YOU FOR REGISTER IN OUR ACCOUNT" . "</div>" . "<a href='http://localhost:8080/website/active.php?code=". $securitycode . "'>" ."http://localhost:8080/website/active.php?code=". $securitycode . "</a>";







    $mail->send();
    echo '<div class="alert alert-success mt-5"> Account successfully created ...  Confirmation message has been sent </div>';


echo '<script> 

setTimeout(function(){
           window.location="register.php"; },2000)
     




</script>';



}else{


echo '<div class="alert alert-danger"> THERE IS SOME THING WRONG </div>';


echo '<script> 

setTimeout(function(){
           window.location="register.php"; },2000)
     




</script>';

}




 }
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