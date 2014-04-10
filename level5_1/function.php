<?php 
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'mysql.php';
/**
 * Получить массив ссылок для текста, на основании количества страниц и 
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
    $result[] = $i == $current ? $i : sprintf('<a href="?page=%d">%d</a>', $i, $i);
  }
  
  return $result;
}


/**
 * Создать из массива сроку с заданным разделителем.
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
function getPagesCount($all, $onPage)
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
  $begin = $onPage * $currentPage - $onPage + 1;
  
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
function getTextByType($fileName, $type)
{
  $text = is_readable($fileName) ? file_get_contents($fileName) : '';
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
  return getFrom($_SESSION, $name, $default);
}

function getFromGet($name, $default = false)
{
  return getFrom($_GET, $name, $default);
}

function getFromPost($name, $default = false)
{
  return getFrom($_POST, $name, $default);
}

function getFrom($array, $name, $default = false)
{
  return isset($array[$name]) ? $array[$name] : $default;
}

/**
 * Отредиректить страницу на нужный пейдж если он передан постом.
 */
function redirectOnPage()
{
  if ($page = getFromPost('current_page'))
  {
    header(sprintf('Location: ?page=%s', $page));
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
  $exit ? exit() : false;
}