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
height:860px !important;


}




.tool_icon{

width:14%;
height:8%;;


}

.mr-l{


margin-left:300px;

}

.mr-b{
margin-bottom:200px;

}


.edit_icon{

width:14%;
height:8%;

}

.editLabel{


width:5%; 
height:3%;
color:red;
background:yellow;
text-align:center;

}

.editLabel:hover{


width:8%; 
height:3%;
color:yellow;
background:red;
text-align:center;

}

</style>

          </head>
          
          
      <body>
<?php  
require_once "nav.php";
?>
<main  class="container main-style">



<form  method="GET" class="mr-b">
<label class="label_font"> Add Category</label> <br><br>
<input class="form-control inp_style" type="text" name="category_name" required /><br><br>
<button type="submit" class="btn btn-success link-style form-control" name="add_category"> Add Category </button>

</form>




<?php

error_reporting(0); ini_set('display_errors', 0);


session_start();
if(isset($_SESSION['user'])){
if($_SESSION['user']->role ==='admin'){




echo '<div class="mr-b"><a href="index.php" style="margin-bottom:200px;" ><img src="img/Home_icon.png" class="tool_icon shake"/></a>

<a href="edit_category.php" class="mr-l"><img src="img/edit_icon2.png" class="edit_icon shake" /> <label class="editLabel">Edit </label></a></div>
';


if(isset($_GET['add_category'])){

require_once "../connectdatabase.php";

$c_name= $_GET['category_name'];

$select_cat = $conn->prepare("SELECT * FROM category WHERE c_name =:c_name");

$select_cat->bindParam("c_name",$c_name);
$select_cat->execute();

if($select_cat->rowCount()>0){

echo "<div class='alert alert-danger'> This category is exsist already </div>";


header("refresh:2;url=http://localhost:8080/website/admin/add_category.php",true);


}else{

$add_cat=$conn->prepare("INSERT INTO category(c_name) VALUES(:c_name)");

$c_name= $_GET['category_name'];
$add_cat->bindParam("c_name",$c_name);

if($add_cat->execute()){

echo "<div class='alert alert-success'> Add category Has been successfuly </div>";

header("refresh:2;url=http://localhost:8080/website/admin/add_category.php",true);

}else{

echo "<div class='alert alert-warning'> There is something wrong</div>";



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
 
           
           
<script
  type="text/javascript"
  src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.js"
></script>
        
        </body>
        
        
     </html>