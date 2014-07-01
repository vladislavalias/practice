<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();

require_once realpath(__DIR__) . '/modules/loadModules.php';

?>
<!DOCTYPE html>
<html>
    <head>
        <title>Админ. панель</title>
        <link rel="stylesheet" type="text/css" href="../style.css">
<!--        <script src="/js/jquery-1.8.2.min.js"></script>
        <script src="/js/main.js"></script>-->
    </head>
    <div><a href="../index.php">Войти как пользователь</a>
    <?php echo (isAuthenticated()) ? 'Здравствуй, '. $_SESSION['login'] : '' ?>
    <?php echo (isAuthenticated()) ? '<a href="log_out.php">Выйти</a>' : '' ?></div>

    <?php

    if (isAuthenticated())
    {
        require_once 'elements.php';
    }

    if (!checkPermission(getModule(), getAction()))
    {
    //  echo showPermissionError();
      echo 'У вас нет прав для просмотра данной страницы';
      exit();
    }

    if (getFromGet('what'))
    {
        require_once sprintf('modules/elements/%s.php', getFromGet('what'));
    }
    ?>
</html>


