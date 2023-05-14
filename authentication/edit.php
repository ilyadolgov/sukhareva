<html>
	<head>
		<title>Страница редактирования</title>
</head>
</body>
<form method="POST">
<?php
session_start();
if(!$_SESSION['username']){
	header("Location: enter.php");
	exit;
}
$id=$_GET['id'];


require_once '../connect.php';
$query = "SELECT * FROM `blogs` WHERE id=$id";
$result = $mysqli->query($query);
//$row = mysqli_fetch_array($result);
while ($row=mysqli_fetch_array($result)) {


  echo "<p><input type='text' name='name'value='".$row['nameblog']."'></p><textarea name='description'>".$row['description']."</textarea>";



} 
?>
<p><button type="submit" name="button">Изменить запись</button></p>
</form>

<?php

if(isset($_POST['button'])) {
$description = $_POST['description'];
$name = $_POST['name'];
if(isset($_POST['button'])) {
$description = $_POST['description'];
$name = $_POST['name'];
require_once '../connect.php';
$query = "UPDATE `blogs` SET `nameblog` = '$name', `description` = '$description', `picture` = '' WHERE `blogs`.`id` = '$id'";
$result = $mysqli->query($query);
header("Location: ../index.php");
}}
?>
</body>
</html>