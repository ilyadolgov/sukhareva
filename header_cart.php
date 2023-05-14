<?php
session_start();
if($_SESSION['username']){


require_once 'connect.php';
$user= $_SESSION['username'];
$count=0;
$price_cart=0;
$query = "SELECT SUM(products.price) FROM products INNER JOIN cart ON products.id = cart.id_product GROUP BY cart.username HAVING (((cart.username)='$user'));";
$result = $mysqli->query($query);
$row=mysqli_fetch_array($result);
if ($row==TRUE)
{
    $price_cart = $row['SUM(products.price)'];
}


$query2 = "SELECT COUNT(cart.id_product) FROM cart GROUP BY cart.username HAVING (((cart.username)='$user'));";
$result2 = $mysqli->query($query2);
$row2=mysqli_fetch_array($result2);
if ($row2==TRUE)
{
    $count = $row2['COUNT(cart.id_product)'];
}


?>


<div>
    <strong>Товаров в корзине: </strong><?php echo $count ?> шт.
     <br/><strong>На сумму: </strong><?php echo $price_cart ?> руб.
</div>

<?php
}
?>