<html>
<head>
    <title>Авторизация/Регистрация</title>
    <link rel="stylesheet" href="../styles/style.css">
    <script src="../scripts/script.js"></script>
</head>
<?php require_once '../navigation.php'; ?>
<?php require_once '../connect.php'; ?>
<body class="bodyautorize">

    <div class="centerform">
<h1>Авторизация</h1>
<img src="../images/admin.png" class="logologin"><br>
<button onclick="login()" class="c-button-login">Авторизация</button>
<button onclick="registr()" class="c-button-registr">Регистрация</button>
<div id="formaauthentication">
<form method="post" class="forma">
    <p><input type="text" placeholder="Имя пользователя" name="name" class="username" required></p>
    <p><input type="password" placeholder="Пароль" name="passwd" class="password" required></p>
    <button type="submit" name="button2" class="c-button-vhod">Войти</button>
</form><br>
</div>

<?php
//Авторизация пользователя
if(isset($_POST['button2'])) {
    $name=$_POST['name'];
    $passwd=$_POST['passwd'];
    $query = "SELECT * FROM `users` WHERE `name`='$name'";
    $result = $mysqli->query($query);
    $row = mysqli_fetch_array($result);
    if (password_verify($passwd,$row['passwd'])) {  
        $_SESSION['username'] = $name;
        header("Location: /sukhareva/index.php");
    }
    else {
        echo "Неправильный логин или пароль!";
    }
    
}

//Регистрация пользователя
if(isset($_POST['button1'])) {

    $username=$_POST['name'];
    $passwd=$_POST['passwd'];
    $passwd2=$_POST['passwd2'];
    if ($passwd==$passwd2) {
        $passwd=password_hash($passwd,PASSWORD_DEFAULT);
        $query = "INSERT INTO `users` (`id`, `name`, `passwd`) VALUES (NULL, '$username', '$passwd')";
        $result = $mysqli->query($query);
        $_SESSION['username'] = $username;
        header("Location: /sukhareva/index.php");

    }
    else {
        echo "Пароли не совпадают";
    }
}

?>
</div>
</body>
</html>