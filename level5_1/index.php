<?php require_once 'function.php' ?>
<!DOCTYPE>
<html>
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  
  <body>
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
                <a href="reader.php?id=<?php echo $book['id'] ?>" style="color: white">Читать</a>
            </span>
          </td>
        </tr>
        <?php endforeach ?>
      </table>
  </body>
</html>