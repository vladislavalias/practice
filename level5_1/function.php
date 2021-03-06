<?php
header("content-type: text/html;charset=utf-8");
session_start();

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'mysql.php';
/**
 * Получить отформатированный массив ссылок для текста, на основании количества страниц и 
 * текущей страницы.
 * 
 * @param integer $num
 * @param integer $current
 * @return array
 */
function getPagesLinks($num, $current)
{
  $result = array();
  for ($i=1; $i<=$num; $i++)
  {
      if($i==1 || $i == $num || $i>=$current-4 && $i<=$current+4)
      {
        $result[] = $i == $current ? $i : sprintf('<a href="?id=%d&page=%d">%d</a>', filter_input(INPUT_GET, 'id'), $i, $i);
      }
      else
      {
          if ($i>=$current-7 && $i<=$current+7)
          {
            $result[] = '.'; 
          }
      }
  }
  return $result;
}


/**
 * Создать из массива строку с заданным разделителем.
 * 
 * @param array $array
 * @param string $format
 * @return string
 */
function formatArray($array, $format = "\n<br />")
{
  return implode($format, $array);
}

/**
 * Посчитать количество страниц на основании массива общего количества
 * и количества контента на странице.
 * 
 * @param array $all
 * @param integer $onPage
 * @return integer
 */
function getPagesCount($all, $onPage = 10)
{
  return ceil(sizeof($all) / $onPage );
}


/**
 * Сохранить требуемый тип показа.
 * 
 * @param string $type
 * @return bool
 */
function saveNewShowType($type)
{
  return $type ? $_SESSION['show_type'] = $type : false;
}

/**
 * Сохранить новые параметры переданные по посту согласно переданному списку имен.
 * 
 * @param array $names
 * @return boolean
 */
function saveNewParameters($names)
{
  if ($names)
  {
    foreach ($names as $name)
    {
      if ($value = getFromPost($name))
      {
        $_SESSION[$name]  = $value;
        $names            = explode('_', $name);
        
        saveNewShowType(array_pop($names));
        saveAllOthersTo($names, $name, '-');
        break;
      }
    }
  }
  
  return true;
}

/**
 * Сохранить все в сессии согласно переданному списку имен, кроме переданных
 * в массиве на то что передано третьим аргументом.
 * 
 * @param array $what
 * @param string|array $exclude
 * @param string $toWhat
 * @return boolean
 */
function saveAllOthersTo($what, $exclude, $toWhat)
{
  $exclude = is_array($exclude) ? $exclude : array($exclude);
  foreach ($what as $one)
  {
    if (in_array($one, $exclude)) continue;
    
    $_SESSION[$one] = $toWhat;
  }
  
  return true;
}

/**
 * Получить количество отображаемого на странице согласно требуемому типу.
 * 
 * @return integer
 */
function getDelimeter()
{
  $delimeterName = sprintf('on_page_%s', getDelimeterType());
  
  return getFromSession($delimeterName);
}

/**
 * Получить тип показываемого контента.
 * 
 * @return string
 */
function getDelimeterType()
{
  return getFromSession('show_type');
}

/**
 * Получить контент согласно нужным параметрам страницы и количеству на ней.
 * 
 * @param array $textArray
 * @param integer $currentPage
 * @param integer $onPage
 * @return array
 */
function getContent($textArray, $currentPage, $onPage)
{
  $begin = $onPage * $currentPage - $onPage;
  
  return array_slice($textArray, $begin, $onPage);
}

/**
 * Получить контент согласно переданному типу.
 * Т.е. читается файл и разбивается тем чем надо в зависимости от типа.
 * 
 * @param string $fileName
 * @param string $type
 * @return array
 */
function getTextByType($allText, $type)
{
  $text = $allText ? $allText['text'] : '';
  switch ($type)
  {
    case 'words': 
      $separator = ' ';
    break;
    default:
      $separator = '.';
    break;
  }
  
  return array_diff(explode($separator, $text), array('', null, false));
}

/**
 * Инициализированеи в массиве данных начальных значений.
 * 
 * @param array $toWhat
 * @param array $params
 * @param bool $force
 */
function init(&$toWhat, $params, $force = false)
{
  if ($params)
  {
    foreach ($params as $oneName => $value)
    {
      if (isset($toWhat[$oneName]) && !$force) continue;
      
      $toWhat[$oneName] = $value;
    }
  }
}

function getFromSession($name, $default = false)
{
  return isset($_SESSION[$name]) ? $_SESSION[$name] : $default;
}

function getFromGet($name, $default = false)
{
  return getFrom(INPUT_GET, $name, $default);
}

function getFromPost($name, $default = false)
{
  return getFrom(INPUT_POST, $name, $default);
}

function getFrom($getFrom, $name, $default = false)
{
  return (filter_input($getFrom, $name)) ? filter_input($getFrom, $name) : $default;
}

/**
 * Отредиректить страницу на нужный пейдж если он передан постом.
 */
function redirectOnPage($id)
{
  if ($page = getFromPost('current_page'))
  {
    header(sprintf('Location: ?id=%d&page=%s', getFromSession('id', 1), $page));
    exit();
  }
}

/**
 * Дамп и выход если второй истина.
 * 
 * @param mixed $var
 * @param bool $exit
 */
function dump($var, $exit = true)
{
  var_dump($var);
  if ($exit) { exit(); }
}

function getBooks()
{
  return mysqlSelect('books');
}

function getBooks2($number)
{
  return mysqlSelect('books, authors', '*', sprintf('books.author_id = authors.id LIMIT %d, 10', ($number - 1) * 10));
}

function getBook($id)
{
  $where = sprintf('book_id = "%d"', $id);
  
  return mysqlSelectOne('books', '*', $where);
}

/**
 * Получить отформатированный массив ссылок для текста, на основании количества страниц и 
 * текущей страницы.
 * 
 * @param integer $num
 * @param integer $current
 * @return array
 */
function getPagesLinks2($num, $current)
{
  $result = array();
  for ($i=1; $i<=$num; $i++)
  {
    $result[] = $i == $current ? $i : sprintf('<a href="?page_books_show=%d">%d</a>', $i, $i);
  }
  return $result;
}