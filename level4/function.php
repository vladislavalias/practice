<?php


/**
 * Извлечение переменной из ПОСТа.
 * 
 * @param string $name Название элемента.
 * @param mixed $default Значение по умолчанию.
 * @return mixed
 */
function getFromPost($name, $default = FALSE)
{
  return getFrom($_POST, $name, $default);
}

/**
 * Проверка на наличие файла, соответствующего переменной.
 * 
 * @param type $array Перечень доступных значений.
 * @param type $name Значение элемента.
 * @param type $default Значение по умолчанию.
 * @return type
 */
function getFrom($array, $name, $default = FALSE)
{
  if (!$array || !$name) return $default;
  
  return array_key_exists($name, $array) ? $array[$name] : $default;
}

/**
 * ����� ���������
 * 
 * @param type $name 
 * @param type $default
 * @return type
 */
function optIsSelected($name, $default = '')
{
    return getFromPost($name) == $name ? 'selected="selected"' : $default;
}

function getFromSession($name)
{  
  return array_key_exists($name, $_SESSION) ? $_SESSION[$name] : '';
}

/**
 * Получение неповторяющейся шутки
 * 
 * @param array $array Массив доступных значений
 * @param array $_SESSION['joke'] Массив использованых значений
 * @return string Неиспользуемое ранее значение
 */
function showJokes ($array)
{
  $n = rand(0, count($array) - 1);
  $showedJokes = $array[$n]; 
  if ((count($_SESSION['joke']) == count($array)))
  {
    $_SESSION['joke'] = array();
  }
  if (in_array($showedJokes, $_SESSION['joke']))
  {
    return showJokes($array);
  }
  else
  {
    array_push($_SESSION['joke'], $showedJokes);
    return $showedJokes;
  }
}

function getSearchParamFromPost($name, $falseValue = false)
{ 
  return $falseValue && $falseValue == getFromPost($name) ? false : getFromPost($name);
}

function extractByName ($array, $fromWhat)
{
  if (!$array || !$fromWhat) return $array;
  
  $result = array();
  
  foreach ($array as $key => $car)
  {
    foreach ($car as $whatSearch => $parameter)
    {
      if ($fromWhat == $whatSearch)
      {
        $result[$key] = $parameter;
      }
    }
  }
  return $result;
}

function searchChooseCars ($baseArray, $whatSearch, $searchFor, $howSearch)
{
  if (!$baseArray || !$whatSearch || !$searchFor) return $baseArray;
  
  $inWhatSearch = extractByName($baseArray, $whatSearch);
  $findedCars   = array();
  
  foreach ($inWhatSearch as $key => $value)
  {
    if ('==' == $howSearch && $value == $searchFor)
    {
      $findedCars[] = $baseArray[$key];
    }
    if ('>=' == $howSearch && $value >= $searchFor)
    {
      $findedCars[] = $baseArray[$key];
    }
    if ('>' == $howSearch && $value > $searchFor)
    {
      $findedCars[] = $baseArray[$key];
    }
    if ('<' == $howSearch && $value < $searchFor)
    {
      $findedCars[] = $baseArray[$key];
    }
    if ('<=' == $howSearch && $value <= $searchFor)
    {
      $findedCars[] = $baseArray[$key];
    }
  }
  return $findedCars;
}

function printFindedCars($cars)
{
  $buffer = '';
  
  foreach ($cars as $key => $value)
  {
    $buffer .= implode(' ', $value) . '<br />';
  }
  return $buffer;
}

function dump($value, $exit = true)
{
  var_dump($value);
  if ($exit) exit();
}