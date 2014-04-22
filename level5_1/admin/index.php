<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
require_once 'function.php';

?>
<!DOCTYPE>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  
  <body>
    <form action="index.php" method="post">
      <div class="admin_panel">
        <h1 style="text-align: center">Вход в панель управления</h1>
        <table style="padding-bottom: 30px">
          <tr>
            <td style="padding-left: 50px">Логин: </td>
            <td style="padding-left: 50px"><input type="text" name="name" value="<?php echo filter_input(INPUT_POST, 'name') ?>"> </td>
          </tr>
          <tr>
            <td style="padding-left: 50px">Пароль:</td>
            <td style="padding-left: 50px"><input type="password" name="pass"></td>
          </tr>
        </table>
      </div>
    </form>
  </body>
</html>

<?php

if (!isset($_SESSION['login']))
{
  $_SESSION['login'] = 0;
}

$login = filter_input(INPUT_POST, 'name');
$pass  = filter_input(INPUT_POST, 'pass');
$where = $name ? sprintf('login=%s', filter_input(INPUT_POST, 'name')) : 1;
$auth  = mysqlSelect('admins', '*', $where);
$userPass  =  getFrom($auth, $login);

if (FALSE !== $userPass && $userPass == md5($pass))
{
  $_SESSION['login'] = $login;
}
elseif($login || $pass)
{
  echo 'Неправильный логин/пароль!';
}

if ($_SESSION['login'])
{
  echo 'Добро пожаловать, '.$_SESSION['login'];
}

if (!$_SESSION['login'])
{
  ?>
  <form action="index.php" method="post">
    Login: <input type="text" name="login" value="<?php echo getFromPost('login') ?>"><br />
    Password: <input type="password" name="pass"><br />
    <input type="submit">
  </form>
<a href="registration.php">Регистрация</a>
  <?php
}
echo sprintf('<img src="%s">', $_SESSION['login'] ? $imgReg : $imgUnreg);
?>

<style type="text/css">
  img
  {
    width: 500px;
  }
</style>

<a href="logout.php">Выйти</a>