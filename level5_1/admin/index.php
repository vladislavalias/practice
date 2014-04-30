<?php
header("content-type: text/html;charset=utf-8");
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();
require_once 'function.php';
mysqlConnect();

?>
<!DOCTYPE>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>

    <?php
    if (!isset($_SESSION['login']))
    {
      $_SESSION['login'] = 0;
    }

    $login = filter_input(INPUT_POST, 'name');
    $pass  = filter_input(INPUT_POST, 'pass');
    $where = $login ? sprintf('admin="%s"', filter_input(INPUT_POST, 'name')) : 1;
    $authes  = mysqlSelect('admins', '*', $where);
    foreach ($authes as $auth)
    {
        $userPass  =  trim($auth['pass']);
    }
    
    if ($userPass == md5($pass))
    {
      $_SESSION['login'] = $login;
    }
    elseif($login || $pass)
    {
      echo 'Неправильный логин/пароль!';
    }

    if ($_SESSION['login'])
    {
      ?>
      <div class="mainpanel">
          <table style="border-spacing: 0px 2px">
          <?php $books = getBooks() ?>
          <?php foreach ($books as $book): ?>
          <tr class="info_book">
            <td style="width: 500px; border-radius: 15px 0px 0px 15px; padding: 10px">
              <?php echo $book['name'].', '.$book['author'] ?> 
            </td>
            <td class="td_read">
              <span>
                  <a href="/level5_1/reader.php?id=<?php echo $book['id'] ?>" style="color: white">Читать</a>
              </span>
            </td>
            <td class="td_read">
              <span>
                  <a href="/level5_1/admin/redact.php?id=<?php echo $book['id'] ?>" style="color: white">Редактировать</a>
              </span>
            </td>
            <td class="td_delete">
              <span>
                  <a href="/level5_1/admin/delete.php?id=<?php echo $book['id'] ?>" style="color: white">Удалить</a>
              </span>
            </td>
          </tr>
          <?php endforeach ?>
          <td colspan="4">
            <span>
              <a href="/level5_1/admin/new_book.php" style="color: white; padding-left: 40%">Добавить новую книгу</a>
            </span>
          </td>
        </table> 
      </div>
      <?php
    }

    if (!$_SESSION['login'])
    {
      ?>
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
        <?php
    }
    ?>
      <a href="/level5_1/index.php">Войти как пользователь</a>
  </body>
</html>