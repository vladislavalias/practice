<<<<<<< HEAD
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
          <td><a href="reader.php?id=<?php echo $book['id'] ?>"><?php echo $book['name'] ?> </a></td>
        </tr>
        <?php endforeach ?>
      </table>
    <?php

    ?> 
  </body>
=======
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
          <td><a href="reader.php?id=<?php echo $book['id'] ?>"><?php echo $book['name'] ?> </a></td>
        </tr>
        <?php endforeach ?>
      </table>
    <?php

    ?> 
  </body>
>>>>>>> c8eab4a86cdd9c0b7fc602e795928d4a805e3eb3
</html>