<?php
require_once 'navigation.php';
if(!$_SESSION['username']){
	header("Location: authentication/enter.php");
	exit;
}
require_once 'connect.php';
$user = $_SESSION['username'];
?>
<html>
    <head>
        <title>Корзина</title>
        <link rel="stylesheet" href="styles/style.css">
</head>
<body>
<?php
$query = "SELECT SUM(products.price) FROM products INNER JOIN cart ON products.id = cart.id_product GROUP BY cart.username HAVING (((cart.username)='$user'));";
$result = $mysqli->query($query);
$row=mysqli_fetch_array($result);

if ($row==TRUE)
{
    $price_cart = $row['SUM(products.price)'];
    echo "Общая стоимость заказа: ".$price_cart." Р.";
}
?>
<form method="POST" action="cart.php">
    <br>
<input type="submit" name="clear" value="Очистить корзину">
</form>
<?php
//Очистка корзины
if (isset($_POST['clear']))
{
    $sqldelete = "DELETE FROM `cart` WHERE username='$user'";
    $mysqli->query($sqldelete);
    header("Location: index.php");
}

//Вывод товаров в корзине
$query = "SELECT cart.username, products.price, products.product_name FROM products INNER JOIN cart ON products.id = cart.id_product WHERE (((cart.username)='$user'));";
$result = $mysqli->query($query);
echo "<table border='1' class='tableadminka'>";
echo "<thead><th>Имя товара</th><th>Цена</th></thead>";
while ($row=mysqli_fetch_array($result)) {
	echo "<tr>";
	echo "</td>"."<td>".$row['product_name']."</td><td>".$row['price']." Р.</td>";
	echo "</tr>";
}    
echo "</table>";
?>
<form method="POST" action="cart.php"><br>
<input type="submit" name="order" value="Оформить заказ">
</form>
<?php
//офорление заказа
if (isset($_POST['order']))
{
$today = date("Y-m-d");
$insert = "INSERT INTO `orders` (`date`, `username`) VALUES ('$today', '$user');";
$resinsert = $mysqli->query($insert);
//Получаем ID заказа
$idorders = $mysqli->insert_id;
$writeorders = "SELECT cart.username, products.price, products.product_name, cart.id_product  FROM products INNER JOIN cart ON products.id = cart.id_product WHERE (((cart.username)='$user'));";
$resultsql = $mysqli->query($writeorders);
while ($row=mysqli_fetch_array($resultsql)) {
    $id_product = $row['id_product'];
    $sqlinsert = "INSERT INTO `products_orders` (`id_orders`, `id_products`) VALUES ('$idorders', '$id_product');";
    $resinsert = $mysqli->query($sqlinsert);
}
    $sqldelete = "DELETE FROM `cart` WHERE username='$user'";
    $mysqli->query($sqldelete);
    header("Location: index.php");
}
?>
</body>
</html>

