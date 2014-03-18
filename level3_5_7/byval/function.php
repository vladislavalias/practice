
<?php

function getFromPost($name, $default = 0)
{
   return array_key_exists($name, $_POST) ? $_POST[$name] : $default;
}

/**
 * Определение количества страниц
 * 
 * @param type mixed $array
 * @param  type float $POST
 * @return type float
 */

function pages($array)
{
   return ceil(count($array) / getFromSession('count_on_page'));
}

/**
 * Отображение заданного количества элементов на странице
 * @param type $array
 * @param type $POST
 */

function filmsShowed($array, $perPage, $pageNumber)
{
    for ($i=1; $i <= $perPage; $i++)
    {
        if (($pageNumber - 1)* $perPage + $i <= count($array))
        {
            echo $array[($pageNumber - 1)* $perPage + $i - 1], '<br />';
        }

    }
}

function getFromGet($name, $default = 0)
{
   return array_key_exists($name, $_GET) ? $_GET[$name] : $default;
}

function getFromSession($name, $default = 0)
{
  return array_key_exists($name, $_SESSION) ? $_SESSION[$name] : $default;
}

function saveCountOnPage($count)
{
  $value = $count ? $count : getFromSession('count_on_page', 5);
  
  $_SESSION['count_on_page'] = $value;
  
  return $_SESSION['count_on_page'];
}