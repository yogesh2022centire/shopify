<?php  
$host = "localhost";
$username = "root";
$password = "";
$database = "shopify";

$conn = mysqli_connect($host, $username, $password, $database);

if(!$conn){
	die("connection error" .mysqli_connect_error());
}
else{
	echo 'connected';
}
?>