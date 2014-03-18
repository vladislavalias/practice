<?php

function init($whatDefault, $howMuchDefault)
{
  if (!getFromSession('devide_by'))
  {
    $whatDefaultName            = sprintf('%s_on_page', $whatDefault);
    $_SESSION['devide_by']      = $whatDefaultName;
    $_SESSION[$whatDefaultName] = $howMuchDefault;
  }
}

function pages($howMuch, $namePost, $default)
{
  return ceil($howMuch / getFromPost ($namePost, $default));
}

function getFromGet ($nameGet, $default = 1)
{
  return array_key_exists($nameGet, $_GET) ? $_GET[$nameGet] : $default;
}

function getFromPost ($namePost, $default = FALSE)
{
  return array_key_exists($namePost, $_POST) ? $_POST[$namePost] : $default;
}

function getFromSession ($name, $default = FALSE)
{
  return array_key_exists($name, $_SESSION) ? $_SESSION[$name] : $default;
}

function printPages ($howMuch, $namePost, $nameGet, $default)
{
  $pages ='';
  for ($i=1; $i<= pages($howMuch, $namePost, $default); $i++)
  {
    if (getFromGet($nameGet, 1) == $i)
    {
      $pages .= $i . '&nbsp';
      continue;
    }
    $pages .= sprintf('<a href="index.php?page=%s">%s</a>&nbsp;', $i, $i);
  }
  return $pages;
}

function loadSentenses ($fileName)
{
  $text       = file_get_contents($fileName);
  $sentenses = explode('.', $text);
  foreach ($sentenses as $key => $value)
  {
    if (!$value) unset ($sentenses[$key]);
  }
  return $sentenses;
}

function loadWords ($fileName)
{
  $text       = file_get_contents($fileName);
  $words = explode(' ', $text);
  foreach ($words as $key => $value)
  {
    if (!$value) unset ($sentenses[$key]);
  }
  return $words;
}

function redirectOnPage($name)
{
  if ($currentPage = getFromPost($name))
  {
    header(sprintf("Location: /level3_7/index.php?page=%d", $currentPage));
    exit();
  }
}

function getDelimeter($name)
{
  $settingName = sprintf('%s_on_page', $name);
  if ($setting = getFromPost($settingName))
  {
    $_SESSION['devide_by'] = $settingName;
  }
  
  return getFromSession($_SESSION['devide_by']);
}

function getData()
{
  $calculateBy  = getFromSession('devide_by');
  $array        = array();
  $howMuch      = getFromSession($calculateBy);
  $result       = '';
  
  switch ($calculateBy)
  {
    case 'words':
      $array = loadWords('text.txt');
      $separator  = ' ';
      break;
    
    default:
      $array      = loadSentenses('text.txt');
      $separator  = '.';
      break;
  }
  $_SESSION['how_much'] = sizeof($array);
  
  $fromWhat = (getFromGet('page', 1) - 1) * $howMuch;
  for ($i = $fromWhat; $i < $fromWhat + $howMuch; $i++)
  {
    if ($i <= count($array) - 1)
    {
      $result .= $array[$i] . $separator;      
    }
  }
  
  return trim($result);
}