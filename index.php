<?php
session_start();
?>
<html>
    <head>
        <title>Интернет магазин</title>
        <link rel="stylesheet" href="styles/style.css">
    </head>
<body class="bodyclass">
<header>
  <?php
  require_once 'navigation.php';
  ?>
    </header>
    <main>
      <section>
      <h1>интернет магазин Бытовой химии и косметики</h1>
      <?php
  require_once 'header_cart.php';
  ?>
<?php
require_once 'connect.php';
$query = "SELECT * FROM `products`";
$result = $mysqli->query($query);
echo "<ul class='list'>";
while ($row=mysqli_fetch_array($result)) {
  echo "<li class='list__item'>";
  echo "<figure class='list__item__inner'><img src='images/product_picture/".$row['picture']."'>";
  echo "<figcaption>".$row['product_name']."</figcaption>";
  echo "<p class='price'>".$row['price']." Р.</p>";
  echo "<p><a href=add_cart.php?id=".$row['id']." class='pay'>Добавить в корзину</a></p>";
  echo "</figure>";
  echo "</li>";
}
echo "</ul>";
?>
      </section>
    </main>
</body>
</html>
