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
background-size:cover
background-attachment:fixed;

}
.main-style{
margin-top:220px !important;
width:100%;
height:1000px !important;


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

margin-bottom:300px;

}


.nav-mar{
width:200px;
text-align:start;


}


.tool_icon{

width:8%;
height:8%;


}

</style>





          </head>
          
          
      <body>



<?php  
require_once "nav.php";
?>

<main class="container main-style mr-b">



<?php



error_reporting(0); ini_set('display_errors', 0);

session_start();
require_once '../connectdatabase.php';
if(isset($_SESSION['user'])){
if($_SESSION['user']->role ==="boss"){
require_once '../connectdatabase.php';
if(isset($_SESSION['userid'])){

$edituser = $conn->prepare("SELECT * FROM register WHERE id =:id");

$edituser->bindParam("id",$_SESSION['userid']);

$edituser->execute();
$edituser = $edituser->fetchObject();

echo '<form method="POST" class="mr-b"><label class="label_font"> Name :</label>
 <input id="textid" class="form-control inp_style" type="text" name="name" value="'.$edituser->name.'"/> <br>

<label class="label_font" >Age:</label> <input class="form-control inp_style" type="date" name="age" value="'.$edituser->age.'" required/> <br>';

echo ' <select class="inp_style" style="background:yellow;border:2px  width:30%; height:40px;" name="activated">';
if($edituser->active ==="1"){

echo '<option value="'. $edituser->active . '">Active account</option>';
 

}else{
echo '<option value="'. $edituser->active . '"> Deactivated account</option>';


}
echo '<option value="0"> Deactivate</option>

echo <option value="1"> Activate</option>
</select> 

<select class="inp_style" style="background:yellow;border:2px  width:30%; height:40px;float:right;" name="role">';

echo '<option value="'.$edituser->role.'">Role  : '.$edituser->role.'</option>';



echo '<option value="boss">boss</option>';
 




echo '<option value="admin"> admin</option>';







echo '<option value="user"> user</option>';



echo '</select>

 <br> <br><br>


<button style="margin-right:100px;" class="btn btn-success form-control link-style" type="submit" name="ative_button" value="'. $edituser->id .'"> UPDATE</button>
<br> <br>



</form> <a href="search.php" class=""><img src="img/back_icon.png" class="tool_icon shake mr-b"/></a>';


}
if(isset($_POST['ative_button'])){

$update = $conn->prepare("UPDATE register SET name =:name ,age =:age, active =:active , role =:role WHERE id =:id");

$update->bindParam("name",$_POST['name']);
$update->bindParam("age",$_POST['age']);
$update->bindParam("active",$_POST['activated']);

$update->bindParam("role",$_POST['role']);


$update->bindParam("id",$_POST['ative_button']);



if($update->execute()){

echo '<div class="alert alert-success">
Data has been updated successfully
</div>';
echo'<script> 

setTimeout(function(){
           window.location="edituser.php"; },2000)
     




</script>';


}}


}else{

header("location:http://localhost:8080/website/login.php",true);
die("");

}
}else{
header("location:http://localhost:8080/website/login.php",true);
die("");
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
