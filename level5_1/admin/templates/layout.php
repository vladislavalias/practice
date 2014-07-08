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
      $adressFileName = sprintf('modules/elements/%s.php', getFromGet('what'));
      if(file_exists($adressFileName) && is_readable($adressFileName))
      {
        require_once $adressFileName;
      }
      else
      {
        echo '.invalid';
      }
    }
    ?>
</html>