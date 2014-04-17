<?php require_once 'function.php' ?>
<?php    redirectOnPage('current_page') ?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
  <?php

    //session_start();

    init($_SESSION, array('on_page_sentenses' => 5, 'on_page_words' => '-', 'show_type' => 'sentenses'));
    saveNewParameters(array('on_page_sentenses', 'on_page_words'));

    $currentPage    = getFromPost('current_page', getFromGet('page', 1));
    $idBook         = getFromGet('id', 0);
    $_SESSION['id'] = $idBook;
    $allDataFromSql = getTextFromSql('books', $idBook);
    $allText        = getTextByType($allDataFromSql, getDelimeterType());
    $content        = getContent($allText, $currentPage, getDelimeter());
    $pages          = getPagesLinks(getPagesCount($allText, getDelimeter()), $currentPage);
    $textSeparator  = 'on_page_sentenses' == getDelimeterType() ? '.' : ' ';
    ?>

    <form action="reader.php?id=<?php echo $idBook ?>" method="post">
      <div class="pages">
        <div class="to-left">
          <input type="text" name="on_page_words" value="<?php echo getFromSession('on_page_words') ?>">
        </div>
    </form>
    <form action="reader.php" method="post">
        <div class="to-center">
          <?php echo formatArray($pages, "&nbsp;\n") ?>
          <input type="text" name="current_page" value="<?php echo $currentPage ?>">
        </div>
    </form>
    <form action="reader.php?id=<?php echo $idBook ?>" method="post">
        <div class="to-right">
          <input type="text" name="on_page_sentenses" value="<?php echo getFromSession('on_page_sentenses') ?>">
        </div> 
      </div> 
    </form>

    <div class="text" > <?php echo formatArray($content, $textSeparator).$textSeparator ?> </div> 


    <form action="reader.php?id=<?php echo $idBook ?>" method="post">
      <div class="pages">
        <div class="to-left">
          <input type="text" name="on_page_words" value="<?php echo getFromSession('on_page_words') ?>">
        </div>
    </form>
    <form action="reader.php" method="post">
        <div class="to-center">
          <?php echo formatArray($pages, "&nbsp;\n") ?>
          <input type="text" name="current_page" value="<?php echo $currentPage ?>">
        </div>
    </form>
    <form action="reader.php?id=<?php echo $idBook ?>" method="post">
        <div class="to-right">
          <input type="text" name="on_page_sentenses" value="<?php echo getFromSession('on_page_sentenses') ?>">
        </div> 
      </div> 
    </form>


  </body>  
</html>


