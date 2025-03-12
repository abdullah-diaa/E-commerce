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

width:130px;
height:40px;
color:yellow;
font-weight:bold;
border:2px solid black;
background:red;
padding:5px ;
text-align:center;
}
 .link-style{
font-weight:bold;
border:2px solid black;
-webkit-text-stroke: 0.12px black;
float:left;
}



.mr-b{

margin-bottom:130px;

}

.mr-l{

margin-left:250px;
}

.nav-mar{
width:200px;
text-align:start;


}


.tool_
{

width:8%;
height:8%;


}
.pos{

width:100%; 
height:500px;
text-align:center;



}   

.pos video{

margin:auto;
border:solid 10px red;

}
.alert-text{

transform: translate(5%,0vh)

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

if(isset($_GET['video_code'])){

require_once "../connectdatabase.php";



$show_video=$conn->prepare("SELECT * FROM video WHERE pro_id =:pro_id");
$show_video->bindParam("pro_id",$_GET['video_code']);
$show_video->execute();
if($show_video->rowCount() >0){


foreach($show_video AS $play_video){






echo '<div class="pos mr-b"><video src="'.$play_video['video']. '" width="500" height="300" controls> </video>  </div>

<div>




<a href="edit_video.php?code_video='.$_GET['video_code'].'" class="btn btn-info link-style " style=margin-left:22%;">Edit </a>
</div>

<div><form method="POST"> 

<button type="submit" class="btn btn-danger link-style mr-l" name="delete_video"> X </button>

</form> </div>
<div style="clear:both;">  </div>
 <a href="productt.php"><img src="img/back_icon.png" class="tool_icon shake mt-5 mr-b"/></a>';



}




}else{


echo '<div style="height:150px !important; text-align:center;" class="alert alert-info"> There is no video for this product (:</div>';

}

if(isset($_POST['delete_video'])){

$delete_video =$conn->prepare("DELETE FROM video WHERE pro_id =:pro_id");

$delete_video->bindParam("pro_id",$_GET['video_code']);



if($delete_video->execute()){


echo '<div class="alert alert-success alert-text "> The video has been deleted successfully</div>';

header("refresh:2;url=http://localhost:8080/website/admin/video.php?video_code=".$_GET['video_code']. "  ",true);

}else{

echo '<div class="alert alert-danger alert-text ">There is something wrong</div>';
header("refresh:2;url=http://localhost:8080/website/admin/video.php?video_code=".$_GET['video_code']. "  ",true);
}
}


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

