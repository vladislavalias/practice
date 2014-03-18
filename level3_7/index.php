<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'function.php';
redirectOnPage('current_page');
session_start();

init('sentenses', 5);
$currentPage  = getFromPost('current_page', getFromGet('page', 1));
$delimeter    = getDelimeter('words') ? getDelimeter('words') : getDelimeter('sentenses');
$text         = getData();
$howMuch      = getFromSession('how_much');

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
      <input type="text" name="words_on_page" value="<?php echo getFromPost('words_on_page', $_SESSION['words_on_page']) ?>">
    </div>
</form>
<form action="index.php" method="post">
    <div class="to-center">
      <?php echo printPages($howMuch, 'sentenses_on_page', 'page', $_SESSION['sentenses_on_page']) ?>
      <input type="text" name="current_page" value="<?php echo $currentPage ?>">
    </div>
</form>
<form action="index.php" method="post">
    <div class="to-right">
      <input type="text" name="sentenses_on_page" value="<?php echo $_SESSION['sentenses_on_page'] ?>">
    </div> 
  </div> 
</form>

<div class="text" > <?php echo $text ?> </div> 
      
<div class="pages">
  <div class="pages">
    <div class="to-left">
      <input type="text" name="words_on_page" value="<?php echo getFromPost('words_on_page', $_SESSION['words_on_page']) ?>">
    </div>
</form>
<form action="index.php" method="post">
    <div class="to-center">
      <?php echo $_SESSION['sentenses_on_page'] != '-' ?
        printPages($sentenses, 'sentenses_on_page', 'page', $_SESSION['sentenses_on_page']) :
        printPages($words, 'words_on_page', 'page', $_SESSION['words_on_page']) ?>
      <input type="text" name="current_page" value="<?php echo $currentPage ?>">
    </div>
</form>
<form action="index.php" method="post">
    <div class="to-right">
      <input type="text" name="sentenses_on_page" value="<?php echo $_SESSION['sentenses_on_page'] ?>">
    </div> 
  </div>
</div>
