<?php require_once 'function.php' ?>
<!DOCTYPE>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  
  <body>
    <div class="mainpanel">
      <table border="1">
        <?php $books = getBooks() ?>
        <?php foreach ($books as $book): ?>
        <tr>
          <td style="width: 235px">
            <?php echo $book['name'].', '.$book['author'] ?> 
            <span class="button">
              <a href="reader.php?id=<?php echo $book['id'] ?>">Читать</a>
            </span>
          </td>
        </tr>
        <?php endforeach ?>
      </table>
    <?php

    ?> 
  </body>
</html>