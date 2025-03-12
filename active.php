<?php


error_reporting(0); ini_set('display_errors', 0);


if(isset($_GET['code'])){
require_once 'connectdatabase.php';




$checklog = $conn->prepare("SELECT * FROM register WHERE securitycode = :securitycode");

$checklog->bindParam("securitycode",$_GET['code']);

$checklog->execute();

if($checklog->rowCount() > 0){

$newsecuritycode =md5(date("h:i:s"));
$updatecode = $conn->prepare("UPDATE register SET securitycode=:newsecuritycode WHERE securitycode=:securitycode");

$updatecode->bindParam("newsecuritycode",$newsecuritycode);
$updatecode->bindParam("securitycode",$_GET['code']);

if($updatecode->execute()){

foreach($checklog AS $data){

if($data['securitycode'] ==$_GET['code']){



$chek_cod =$conn->prepare("SELECT * FROM register WHERE email=:email AND password=:password");

$chek_cod->bindParam("email",$email);
$chek_cod->bindParam("password",$password);

$chek_cod->execute();
$chel_cod_scu =$chek_cod->fetchObject();






$update_act = $conn->prepare("UPDATE register SET active = true WHERE email =:email");


$update_act->bindParam("email",$data['email']);


if($update_act->execute()){

$login= $conn->prepare("SELECT * FROM register WHERE email=:email AND password=:password");

$password=($data['password']);
$email = $data['email'];

$login->bindParam("email",$email);
$login->bindParam("password",$password);


$login->execute();


if($login->rowCount() ===1){
   
$userdata = $login->fetchObject();
if($userdata->active ==1){

session_start();
   $_SESSION['user'] = $userdata;
if($userdata->role ==="user"){
echo 'Account verified successfully';
echo '<a href="user/index.php"> Complete the login process</a>';

}else if($userdata->role ==="admin"){
echo 'Account verified successfully';
echo '<a href="admin/index.php"> Complete the login process</a>';

}else if($userdata->role ==="boss"){
echo 'Account verified successfully';
echo '<a href="boss/index.php"> Complete the login process</a>';

}}
}













}









}else{


echo '<div class="alert alert-danger mt-5">This code has been disabled </div>';

echo '<script> 

setTimeout(function(){
           window.location="login.php"; },2000)
     




</script>';


}


}}

}else{


echo '<div class="alert alert-danger mt-5">This code has been disabled </div>';

echo '<script> 

setTimeout(function(){
           window.location="login.php"; },2000)
     




</script>';


}
}

?>