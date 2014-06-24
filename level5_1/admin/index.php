<?php
session_start();
if (!isset($_SESSION['login'])) $_SESSION['login'] = '';

require_once realpath(__DIR__) . '/modules/loadModules.php';

if(!$_SESSION['login'])
{
    require_once realpath(__DIR__) . '/sign_form.php';
    exit();
}
?>

<div class="title"><a href="/../index.php">Войти как пользователь</a>
<?php echo ($_SESSION['login']) ? 'Здравствуй, '. $_SESSION['login'] : '' ?>
<?php echo ($_SESSION['login']) ? '<a href="logOut.php">Выйти</a>' : '' ?></div>

<?php

if (!checkPermission(getModule(), getAction()))
{
//  echo showPermissionError();
  echo 'У вас нет прав для просмотра данной страницы';
  exit();
}