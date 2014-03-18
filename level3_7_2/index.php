<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'function.php';
redirectOnPage('current_page');
session_start();

init($_SESSION, array('on_page_sentenses' => 5, 'on_page_words' => '-', 'show_type' => 'sentenses'));
saveNewParameters(array('on_page_sentenses', 'on_page_words'));

$currentPage    = getFromPost('current_page', getFromGet('page', 1));
$allText        = getTextByType('text.txt', getDelimeterType());
$content        = getContent($allText, $currentPage, getDelimeter());
$pages          = getPagesLinks(getPagesCount($allText, getDelimeter()), $currentPage);
$textSeparator  = 'semtenses' == getDelimeterType() ? '.' : ' ';

?>
<style type="text/css">
  input {
    width: 25px;
  }
  form {
    margin: 0px;
    padding: 0px;
  }
  .text {
    border: 1px solid black;
    width: 600px;
    height: auto;
    margin: 0px auto;
    padding: 10px;
    text-align: justify;
  }
  .pages {
    width: 622px;
    height: auto;
    margin: 0px auto;
    padding: 0px auto;
    text-align: center;
    padding: 5px 0px;
  }
  .to-left {
    float: left;
    width: 30px;
  }
  .to-center {
    float: left;
    width: 540px;
    overflow: hidden;
  }
  .to-right {
    float: right;
    width: 30px;
  }
</style>

<form action="index.php" method="post">
  <div class="pages">
    <div class="to-left">
      <input type="text" name="on_page_words" value="<?php echo getFromSession('on_page_words') ?>">
    </div>
</form>
<form action="index.php" method="post">
    <div class="to-center">
      <?php echo formatArray($pages, "&nbsp;\n") ?>
      <input type="text" name="current_page" value="<?php echo $currentPage ?>">
    </div>
</form>
<form action="index.php" method="post">
    <div class="to-right">
      <input type="text" name="on_page_sentenses" value="<?php echo getFromSession('on_page_sentenses') ?>">
    </div> 
  </div> 
</form>

<div class="text" > <?php echo formatArray($content, $textSeparator) ?> </div> 
      
<div class="pages">
  <div class="pages">
    <div class="to-left">
      <input type="text" name="on_page_words" value="<?php echo getFromSession('on_page_words') ?>">
    </div>
</form>
<form action="index.php" method="post">
    <div class="to-center">
      <?php echo formatArray($pages, "&nbsp;\n") ?>
      <input type="text" name="current_page" value="<?php echo $currentPage ?>">
    </div>
</form>
<form action="index.php" method="post">
    <div class="to-right">
      <input type="text" name="on_page_sentenses" value="<?php echo getFromSession('on_page_sentenses') ?>">
    </div> 
  </div>
</div>
