<?php

function extractFrom($array, $name, $default = FALSE)
{
  return array_key_exists($name, $array) ? $array[$name] : $default;
}

function extractPageCurrent()
{
  return extractFrom($_GET, 'page', 1);
}

function extractPageOnPage()
{
  return extractFrom($_SESSION, 'page_on_page', 5);
}

function extractPageCount($array, $onPage)
{
  return ceil(sizeof($array) / $onPage);
}

function getFilmsOnPage($array, $currentPage, $onPage)
{
  return array_slice($array, ($currentPage - 1) * $onPage, $onPage);
}

function saveOnPageValue()
{
  $value = extractFrom($_POST, 'count_per_page');
  if ($value)
  {
    $_SESSION['page_on_page'] = $value;
  }
  
  return $value;
}