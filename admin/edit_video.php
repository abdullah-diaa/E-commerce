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
background-size:100% 1350px;
background-size:cover
background-attachment:fixed;

}
.main-style{
margin-top:80px !important;
width:100%;
height:1050px !important;


}



.name-font{

font-family: 'Oleo Script Swash Caps', cursive;
}


.cont_font{


font-family: 'Domine', serif;
}
.label_font{

width:120px;
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
.mr-b{

margin-bottom:150px;

}


.nav-mar{
width:200px;
text-align:start;


}


.tool_icon{

width:8%;
height:8%;


}
.link-style{
font-weight:bold;
border:2px solid black;
-webkit-text-stroke: 0.12px black;
}
.alert-text{

transform: translate(5%,45vh)

}
       
       
.alert-text{

transform: translate(5%,45vh)

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
if($_SESSION['user']->role ==='admin'){



if(isset($_GET['code_video'])){
require_once "../connectdatabase.php";

if(isset($_POST['update_video'])){

$vid_name ="videos/".$_FILES['file']['name'];

$vid_tmp =$_FILES['file']['tmp_name'];

move_uploaded_file($vid_tmp,$vid_tmp);


$update_video = $conn->prepare("UPDATE video SET video =:video WHERE pro_id =:pro_id");

$update_video->bindParam("video",$vid_name);
$update_video->bindParam("pro_id",$_GET['code_video']);

if($update_video->execute()){

echo '<div class="alert alert-success alert-text">The video has been successfully updated </div>';

header("refresh:2;url=http://localhost:8080/website/admin/edit_video.php?code_video=".$_GET['code_video']. "  ",true);


}else{

echo '<div  class="alert alert-danger alert-text">   There is something wrong </div>';

header("refresh:2;url=http://localhost:8080/website/admin/edit_video.php?code_video=".$_GET['code_video']. "  ",true);


}

}





echo '<div class="mr-b"><form method="POST" enctype="multipart/form-data"> 
<label class="label_font">Add video:</label>
<br> <br>
<input class="inp_style form-control" type="file" name="file" accept="video/*"/>

<br> <br> <br>

<button class="btn btn-success form-control link-style" type="submit"  name="update_video"> update</button>




  </form></div>
  <div class="alert alert-warning" role="alert"> <h4 class="alert-heading">Notice</h4> <p>This page is to update a video clip of your product and the clip must be licensed and not have copyright..so that it is ideally uploaded on the Internet..In addition, the clip must be short, Small size, limited between 1 minute so that you do not face any problems that may hinder this process And remember that you can only upload one video per product.</p> <hr> <p class="mb-0">Videos are very important to attract customers to your product.</p> </div>
<a href="products.php"><img src="img/back_icon.png" class="tool_icon shake mt-5 mr-b"/></a>';

 




}


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
 


<!-- MDB -->
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"
></script>



</body>
         </html>

