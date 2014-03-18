<?php

session_start();

// значит есть допустим список фильмов (заполнить по выбору штук 20)
// индекс страница должна показывать некоторое их количество
// почему некоторое? хаха) потому что должно быть две фичи
// первая количество фильмов на странице, вторая страница для показа
// например страница 1 показывает 5 фильмов - соответственно страниц будет 4
// где на первой будут первые пять результатов
// переход по страницам сделать с помощью ссылки
// количество результатов на странице сделать с помощью инпута и сохранять его скажем в сессию
// так же показывать общее количество доступных для просмотра страниц
// основываясь на текущем количестве для показа на одной

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'function.php';

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

saveOnPageValue();

$pageCurrent  = extractPageCurrent();
$pageOnPage   = extractPageOnPage();
$pageCount    = extractPageCount($films, $pageOnPage);

echo implode('<br />', getFilmsOnPage($films, $pageCurrent, $pageOnPage));

?>

<form action="index.php" method="post">
  <input type="text" name="count_per_page" value="<?php echo $pageOnPage ?>" />
  <input type="submit" value="Показать" />
</form>

<?php 
  for ($i = 1; $i <= $pageCount; $i++) echo sprintf('<a href="?page=%d">%d</a>&nbsp;', $i, $i);
?>
