<?php
header("content-type: text/html;charset=utf-8");
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();
require_once 'function.php';

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Административная панель</title>
  </head>
  <body>

    <?php
    if (!isset($_SESSION['login']))
    {
      $_SESSION['login'] = 0;
    }
    if (!isset($_SESSION['permission']))
    {
      $_SESSION['permission'] = 0;
    }
    $login = addslashes(trim(getFromPost('name')));
    $pass  = trim(getFromPost('pass'));
    $where = $login ? sprintf('admin="%s" AND pass="%s"', $login, md5($pass)) : 1;
    $user  = array_shift(mysqlSelect('admins', '*', $where));

    if ($login || $pass)
    {
        if (count($user) != 0)
        {
          $_SESSION['login'] = $login;
          $_SESSION['permission'] = $user['permission'];
        }
        else
        {
          echo 'Неправильный логин/пароль!';
        }
    }
      ?>
        <table>
          <tr>
              <td style="width: 300px"  align="center"><a href="<?php echo getUrl('user') ?>index.php">Войти как пользователь</a></td>
              <td style="width: 1200px" align="center" <?php echo (!$_SESSION['login']) ? 'hidden="true"' : '' ?>><p>Здравствуй, <?php echo $_SESSION['login'] ?>!</p></td>
              <td style="width: 300px"  align="center" <?php echo (!$_SESSION['login']) ? 'hidden="true"' : '' ?>><a href="<?php echo getUrl() ?>logOut.php">Выйти</a></td>
          </tr>
        </table>
      <?php if ($_SESSION['login']): ?>
      <div class="mainpanel">
          <table style="border-spacing: 0px 2px">
          <tr class="info_book">
            <?php if (permission($user, 'PERMISSION_BOOKS_EDIT')): ?>
            <td style="padding: 10px">
                <a href="<?php echo getUrl('books/index.php') ?>">Перейти к редактированию книг</a>
            </td>
            <?php endif; ?>
          </tr>
          <tr class="info_book">
            <?php if (permission($user, 'PERMISSION_AUTHORS_EDIT')): ?>
            <td style="width: 500px; border-radius: 15px 0px 0px 15px; padding: 10px">
                <a href="<?php echo getUrl('authors/index.php') ?>">Перейти к редактированию авторов</a>
            </td>
            <?php endif; ?>
          </tr>
          <tr class="info_book">
            <?php if (permission($user)): ?>
            <td style="width: 500px; border-radius: 15px 0px 0px 15px; padding: 10px">
                <a href="<?php echo getUrl('admins/index.php') ?>" style="text-align: center">Перейти к редактированию админов</a>
            </td>
            <?php endif; ?>
          </tr>
        </table> 
      </div>
      <?php endif; 


      if (!$_SESSION['login']): ?>
        <form action="index.php" method="post">
          <div class="admin_panel">
            <h1 style="text-align: center">Вход в панель управления</h1>
            <table style="padding-bottom: 30px">
              <tr>
                <td style="padding-left: 90px">Логин: </td>
                <td style="padding-left: 0px"><input type="text" name="name" value="<?php echo filter_input(INPUT_POST, 'name') ?>"> </td>
              </tr>
              <tr>
                <td style="padding-left: 90px">Пароль:</td>
                <td style="padding-left: 0px"><input type="password" name="pass"></td>
              </tr>
              <tr>
                  <td colspan="2" style="padding-left: 40%"><input type="submit"></td>
              </tr>
            </table>
          </div>
        </form>
        <?php endif; ?>
  </body>
</html>
