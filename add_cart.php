<?php 
session_start();
if(!$_SESSION['username']){
	header("Location: authentication/enter.php");
	exit;
}

$id=$_GET['id'];
$user= $_SESSION['username'];
require_once 'connect.php';
$query = "INSERT INTO `cart` (`id`, `username`, `id_product`) VALUES (NULL, '$user', '$id')";
$result = $mysqli->query($query);
header("Location: index.php");
?>