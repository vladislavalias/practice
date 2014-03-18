<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();

require_once 'function.php';

if (!isset($_SESSION['login']))
{
  $_SESSION['login'] = 0;
}


$imgUnreg = '/level3_8/images/unregister.jpg';
$imgReg = '/level3_8/images/login.jpg';

$auth  = parseData(getAllAuth('auth.pass'));
$login = getFromPost('login');
$pass  = getFromPost('pass');
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