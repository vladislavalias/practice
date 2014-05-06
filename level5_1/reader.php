<?php require_once 'function.php' ?>
<?php    redirectOnPage('current_page') ?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>
  <?php
    init($_SESSION, array('on_page_sentenses' => 5, 'on_page_words' => '-', 'show_type' => 'sentenses'));
    saveNewParameters(array('on_page_sentenses', 'on_page_words'));
    
    $idBook         = getFromGet('id', 0);
    $currentPage    = getFromPost('current_page', getFromGet('page', 1));
    $_SESSION['id'] = $idBook;
    $allDataFromSql = getBook($idBook);
    $allText        = getTextByType($allDataFromSql, getDelimeterType());
    $content        = getContent($allText, $currentPage, getDelimeter());
    $numberPage     = getPagesCount($allText, getDelimeter());
    $pages          = getPagesLinks($numberPage, $currentPage);
    $textSeparator  = 'sentenses' == getDelimeterType() ? '.' : ' ';
    if ($currentPage > $numberPage) $currentPage = 0;
    ?>

    <form action="reader.php?id=<?php echo $idBook ?>" method="post">
      <div class="pages">
        <div class="to-left">
          <input type="text" name="on_page_words" value="<?php echo 'words' == getDelimeterType() ? getFromSession('on_page_words') : '-' ?>">
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
          <input type="text" name="on_page_sentenses" value="<?php echo 'sentenses' == getDelimeterType() ? getFromSession('on_page_sentenses') : '-' ?>">
        </div> 
      </div> 
    </form>

    <div class="text" > <?php echo $idBook != 0 && $currentPage != 0 ? formatArray($content, $textSeparator).$textSeparator : 'Нет такой книги или страницы, БЛЕАТЬ! Хватит меня ломать!' ?> </div> 

    <form action="reader.php?id=<?php echo $idBook ?>" method="post">
      <div class="pages">
        <div class="to-left">
          <input type="text" name="on_page_words" value="<?php echo 'words' == getDelimeterType() ? getFromSession('on_page_words') : '-' ?>">
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
          <input type="text" name="on_page_sentenses" value="<?php echo 'sentenses' == getDelimeterType() ? getFromSession('on_page_sentenses') : '-' ?>">
        </div> 
      </div> 
    </form>

    <div class="choose_books"><a href="index.php">Перейти к списку книг</a></div>
  </body>  
</html>


