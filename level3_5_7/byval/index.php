<?php

session_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once 'function.php';

saveCountOnPage(getFromPost('number_elements'));

$films = array(
    'film1',
    'film2',
    'film3',
    'film4',
    'film5',
    'film6',
    'film7',
    'film8',
    'film9',
    'film10',
    'film11',
    'film12',
    'film13',
    'film14',
    'film15',
    'film16',
    'film17',
    'film18',
    'film19',
    'film20'
);

$page = pages($films);
$list = filmsShowed($films, getFromSession('count_on_page'), getFromGet('page', 1));

?>
<form action="index.php" method="post">
  <input type="text" name="number_elements" value="<?php echo getFromSession('count_on_page') ?>">
    <input type="submit">
</form>


<?php

for ($i = 1; $i <= $page; $i++)
{
  if (getFromGet('page', 1) == $i)
  {
    echo $i;
  }
  else
  {
    ?>
    <a href="<?php echo sprintf('index.php?page=%s', $i) ?>"> <?php echo $i ?> </a>
    <?php
  }
}


