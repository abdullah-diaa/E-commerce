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
background-color:lightblue;
}


.main-style{
margin-top:220px !important;
width:100%;
height:1300px !important;

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

margin-bottom:350px;

}


.nav-mar{
width:200px;
text-align:start;


}


.tool_icon{

width:14%;
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




session_start();
require_once '../connectdatabase.php';
if(isset($_SESSION['user'])){
if($_SESSION['user']->role ==="boss"){

echo '<form method="GET" class="mr-b"> <label class="label_font">Name or Email </label>
<br> <br>
<input id="textid" class="form-control inp_style cont_font" type="text" name="search" /> <br> <br>

<button class="btn btn-primary form-control link-style" type="submit" name="search_user">Search</button>
</form>';
if(isset($_GET['search_user'])){

$search_item = $conn->prepare("SELECT * FROM register WHERE name LIKE :name OR email LIKE :email");

$name = "%" . $_GET['search'] . "%";
$email = "%" . $_GET['search'] . "%";

$search_item->bindParam("name",$name);
$search_item->bindParam("email",$email);

$search_item->execute();

echo '<table class="table table-striped mt-5 mr-b" style="border:2px solid red; background:white;">';

echo '<tr>' ;

echo '<th> name </th>';

echo '<th> email </th>';

echo '<th> delete </th>';

echo '<th> edit </th>';

echo '</tr>' ;

foreach($search_item AS $user_data){

echo '<tr>';

echo '<td>' . $user_data['name'] . '</td>';
echo '<td>' . $user_data['email'] . '</td>';

echo '<td> <form method="GET" >
<button  class="btn btn-danger btn-sm" type="submit" name="deletebut" value="'. $user_data['id'].'"> delete</button></form></td>';


echo '<td> <form method="GET">
<button  class="btn btn-success btn-sm" type="submit" name="editbut" value="'. $user_data['id'].'">edit</button></form></td>';
echo '</tr>';
}

echo '</table>';




}

echo '<a href="index.php" class="mr-b" style="margin-bottom:200px;" ><img src="img/Home_icon.png" class="tool_icon shake"/></a>';

if(isset($_GET['deletebut'])){


$drop_foreing_customer=$conn->prepare("ALTER TABLE customer
DROP FOREIGN KEY `customer_ibfk_2`");


$drop_foreing_customer2=$conn->prepare("ALTER TABLE customer
DROP FOREIGN KEY `customer_ibfk_1`");


$delete_cus =$conn->prepare("DELETE FROM customer WHERE user_id =:user_id");

$delete_cus->bindParam("user_id",$_GET['deletebut']);
$delete_cus->execute();
$delete_user = $conn->prepare("DELETE FROM register WHERE id=:id");

$delete_user->bindParam("id",$_GET['deletebut']);
if($delete_user->execute()){


$add_foreign_key_cus1 =$conn->prepare("ALTER TABLE `customer` ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`pro_id`) REFERENCES `add_product`(`p_id`) ON DELETE CASCADE ON UPDATE CASCADE");



$add_foreign_key_cus2 =$conn->prepare("ALTER TABLE `customer` ADD CONSTRAINT `customer_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `register`(`id`) ON DELETE CASCADE ON UPDATE CASCADE");



echo '<div class="alert alert-success">User deleted successfully</div>';

 echo 
 
'<script> 

setTimeout(function(){
           window.location="search.php"; },2000)
     




</script>';


}}
if(isset($_GET['editbut'])){

session_start();

$_SESSION['userid'] =$_GET['editbut'];
 echo 
 
'<script> 


 location.assign("edituser.php");

</script>';

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