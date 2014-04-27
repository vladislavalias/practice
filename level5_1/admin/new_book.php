<?php require_once 'function.php' ?>
<?php require_once 'logVerification.php' ?>
<!DOCTIPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
    <form action="new_book.php" method="post">
      <table>
          <tr>
              <td>Название книги:</td>
              <td><input type="text" name="add_name" value="<?php echo getFromPost('add_name') ?>"></td>
          </tr>
          <tr>
              <td>Автор:</td>
              <td><input type="text" name="add_author" value="<?php echo getFromPost('add_author') ?>"></td>
          </tr>
          <tr>
              <td>Содержание:</td>
              <td>
                  <textarea class="text" name="add_text">
                      <?php echo getFromPost('add_text') ?>
                  </textarea>                
              </td>
          </tr>
      </table>
      <input type="submit" value="Добавить">
    </form>
    <a href="index.php">Перейти к списку книг</a>  <br />
  </body>
</html>



<?php
require_once 'saveForm.php';

