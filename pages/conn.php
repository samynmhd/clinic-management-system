<?php

$conn=mysqli_connect("localhost","root","");
$db=mysqli_select_db($conn,"clinicmanagement");

if($conn->connect_error){
	die("Connection Failed: ".$conn->conect_error);
}
#echo "Connected Succesfully";

?>