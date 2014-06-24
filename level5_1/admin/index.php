<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();

require_once realpath(__DIR__) . '/modules/loadModules.php';

?>

<div class="title"><a href="../index.php">Войти как пользователь</a>
<?php echo (isAuthenticated()) ? 'Здравствуй, '. $_SESSION['login'] : '' ?>
<?php echo (isAuthenticated()) ? '<a href="log_out.php">Выйти</a>' : '' ?></div>

<?php

require_once '';
if (!checkPermission(getModule(), getAction()))
{
//  echo showPermissionError();
  echo 'У вас нет прав для просмотра данной страницы';
  exit();
}
