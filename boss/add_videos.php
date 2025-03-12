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

width:250px;
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
if($_SESSION['user']->role ==='boss'){

if(isset($_GET['product_id_cod'])){

if(isset($_POST['add_video'])){


require_once "../connectdatabase.php";

$video_name ="videos/".$_FILES['video']['name'];

$video_tmp=$_FILES['video']['tmp_name'];


move_uploaded_file($video_tmp,$video_name);

$select_vid =$conn->prepare("SELECT * FROM video WHERE pro_id =:pro_id");
$select_vid->bindParam("pro_id",$_GET['product_id_cod']);
$select_vid->execute();
if($select_vid->rowCount() >0){

echo '<div class="alert alert-warning alert-text">There is already a video</div>';


header("refresh:2;url=http://localhost:8080/website/boss/add_videos.php?product_id_cod=".$_GET['product_id_cod']. "  ",true);
}else{

$add_vid =$conn->prepare("INSERT INTO video(video,pro_id) VALUES(:video,:pro_id)");
$add_vid->bindParam("video",$video_name);
$add_vid->bindParam("pro_id",$_GET['product_id_cod']);


if($add_vid->execute()){
echo "<div class='alert alert-success alert-text'>The video has been uploaded successfully</div>";


header("refresh:2;url=http://localhost:8080/website/boss/add_videos.php?product_id_cod=".$_GET['product_id_cod']. "  ",true);



}else{
"<div class='alert alert-warning alert-text'>There is something wrong</div>";

}
}}




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


<form method="POST" enctype="multipart/form-data" class="mr-b">

<label class="label_font"> Add video about your product:  </label> <br> <br>
<input type="file" name="video" accept="video/*" class="form-control inp_style" />


<br>  <br>  <br>
<button type="submit" name="add_video" class="btn btn-primary link-style form-control" >POST </button>


</form>
<div class="alert alert-primary" role="alert"> <h4 class="alert-heading">Notice</h4> <p>This page is to upload a video clip of your product and the clip must be licensed and not have copyright..so that it is ideally uploaded on the Internet..In addition, the clip must be short,Small size limited between 1 minute so that you do not face any problems that may hinder this process And remember that you can only upload one video per product.</p> <hr> <p class="mb-0">Videos are very important to attract customers to your product.</p> </div>
<a href="productt.php"><img src="img/back_icon.png" class="tool_icon shake mt-5 mr-b"/></a>



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

