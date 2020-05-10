<?php

session_start();


$con = mysqli_connect('localhost','root','');

mysqli_select_db($con,'userregistration1');

$name = $_POST['user'];
$pass = $_POST['password'];

$s = " SELECT * FROM `usertable` where name ='$name' && password = '$pass'";

$result = mysqli_query($con , $s);

$num = mysqli_num_rows($result);

if($num == 1){
    header('location:index.html');
}else{
   header('location:login.php')
}

?>