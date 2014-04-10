<?php require_once 'function.php' ?>
<!DOCTYPE>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  
  <body>
    <div class="mainpanel">
      <table>
        <?php $books = mysqlSelect('books') ?>
        <?php foreach ($books as $book): ?>
        <tr>
          <td><a href="reader.php?id=<?php echo $book['id'] ?>"><?php echo $book['name'] ?> </a></td>
        </tr>
        <?php endforeach ?>
      </table>
    <?php

    ?> 
  </body>
</html>