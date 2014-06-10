<?php
header("content-type: text/html;charset=utf-8");
error_reporting(E_ALL);
ini_set("display_errors", 1);

session_start();
$_SESSION['user']['permission'] = array('ROLE_BOOK_SHOW', 'ROLE_AUTHOR_SHOW', 'ROLE_SUPER_ADMIN');
//require_once 'modules/lib/loadLib.php';

?>
<!DOCTYPE>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>

    <?php
    if (!isset($_SESSION['permission']))
    {
      $_SESSION['permission'] = 1;
    }
    if (!isset($_SESSION['login']))
    {
      $_SESSION['login'] = 0;
    }
    $login = addslashes(trim(getFromPost('name')));
    $pass  = trim(getFromPost('pass'));
    $currentPage = getFromGet('page_books_show', 1);
    $pages = getPagesLinks(getPagesCount(mysqlSelect('books')), $currentPage);
    
    if ($login || $pass)
    {
        $where = $login ? sprintf('admin="%s" AND pass="%s"', $login, md5($pass)) : 1;
        $user  = mysqlSelectOne('admins', '*', $where);
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
      <?php

    if ($_SESSION['login'])
    {
      ?>
      <div class="mainpanel">
          <table style="border-spacing: 0px 2px">
          <?php $books = getBooks($currentPage) ?>
          <?php foreach ($books as $book): ?>
          <tr class="info_book">
            <td style="width: 500px; border-radius: 15px 0px 0px 15px; padding: 10px">
              <?php echo $book['name'].', '.$book['author'] ?> 
            </td>
            <td class="td_read">
              <span>
                  <a href="<?php echo getUrl('user') ?>reader.php?id=<?php echo $book['id'] ?>" style="color: white">Читать</a>
              </span>
            </td>
            <td class="td_read">
              <span>
                  <a <?php if ($_SESSION['permission'] < 3) { echo 'hidden="true"'; } ?> href="<?php echo getUrl() ?>redact.php?id=<?php echo $book['id'] ?>" style="color: white">Редактировать</a>
              </span>
            </td>
            <td class="td_delete">
              <span>
                  <a <?php if ($_SESSION['permission'] < 3) { echo 'hidden="true"'; } ?>  onclick="return confirm('Жахнем?');" href="<?php echo getUrl() ?>delete.php?id=<?php echo $book['id'] ?>" style="color: white">Удалить</a>
              </span>
            </td>
          </tr>
          <?php endforeach ?>
          <tr>
              <td colspan="10" align="center">
                <?php echo formatArray($pages, "&nbsp;\n") ?>
              </td>
          </tr>
          <td colspan="4">
            <?php echo userGetMenu() ?>
            <span>
              <?php if ($_SESSION['permission'] > 3): ?>
                <a href="<?php echo getUrl() ?>new_book.php" style="color: black; padding-left: 40%">Добавить новую книгу</a>
              <?php endif; ?>
            </span>
          </td>
        </table> 
      </div>
      <?php
    }

    if (!$_SESSION['login']):
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
        <?php endif; ?>
      
      
  </body>
</html>

    