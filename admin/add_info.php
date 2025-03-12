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
</head>



<body>
<main class="container mr-b mr-t">
<?php

error_reporting(0); ini_set('display_errors', 0);


session_start();
if(isset($_SESSION['user'])){
if($_SESSION['user']->role ==='admin'){


echo '<form>
















</form>';




}

else{

session_unset();
session_destroy();
header("location:http://localhost:8080/website/login.php",true);




}}else{

session_unset();
session_destroy();
header("location:http://localhost:8080/website/login.php",true);


}


?>

