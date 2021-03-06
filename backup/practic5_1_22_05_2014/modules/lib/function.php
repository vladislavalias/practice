<?php

function getBooks($number)
{
  return mysqlSelect('books', '*', sprintf('1 LIMIT %d, 10', ($number - 1) * 10));
}

function getFromPost($name, $default = false)
{
  return getFrom(INPUT_POST, $name, $default);
}

function getFromGet($name, $default = false)
{
  return getFrom(INPUT_GET, $name, $default);
}

function getFrom($getFrom, $name, $default = false)
{   
  return (filter_input($getFrom, $name)) ? filter_input($getFrom, $name) : $default;
}

function getUser()
{
  return isset($_SESSION['user']) ? $_SESSION['user'] : array();
}

function getFromArray($array, $name, $default = false)
{
  return isset($array[$name]) ? $array[$name] : $default;
}

function dump($values, $exit = true)
{
  var_dump($values);
  if ($exit) exit();
}

/** Получение абсолютной ссылки без учета параметров GET
 * 
 * @return string
 */
function getUrl ($name = 'admin')
{
    $urlParam = array_diff(explode('/', filter_input(INPUT_SERVER, "SCRIPT_NAME")), array('', NULL, FALSE));
    array_pop($urlParam);
    if($name != 'admin') 
    {
        array_pop($urlParam);
    }
    if (count($urlParam) > 1)
    {
        $url = implode('/', $urlParam).'/';
    }
    elseif(count($urlParam) == 1)
    {
        $url = array_pop($urlParam).'/';
    }
    else
    {
        $url = '';
    }
    $adress = sprintf('http://%s/%s', filter_input(INPUT_SERVER, "HTTP_HOST"), $url);
    return $adress;
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
    $result[] = $i == $current ? $i : sprintf('<a href="?page_books_show=%d">%d</a>', $i, $i);
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