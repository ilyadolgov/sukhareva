<?php session_start();?>
  <div class="navigation">
      <p><a href="/sukhareva">Главная страница</a>
      <?php if(!$_SESSION['username']){
        echo "<a href='/sukhareva/authentication/enter.php'> | Выполнить вход / Регистрация | </a>";
      } ?>
      

      <?php if($_SESSION['username']){
        echo "<a href='cart.php'> | Корзина </a>";
        echo " | Добро пожаловать, ".$_SESSION['username'];
        echo "<a href='/sukhareva/authentication/logout.php'> | Выйти </a></p>";
      }
      ?>
      </div>
