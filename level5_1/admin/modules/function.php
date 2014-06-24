<?php

function getFrom($inputType, $name, $filter = FILTER_DEFAULT, $options = FILTER_REQUIRE_SCALAR)
{
  return filter_input($inputType, $name, $filter, $options);
}

function getFromPostArray($name, $filter = FILTER_DEFAULT)
{
  return getFrom(INPUT_POST, $name, $filter, FILTER_REQUIRE_ARRAY);
}

function getFromPost($name)
{
  $getFrom = getFrom(INPUT_POST, $name);
  return $getFrom ? $getFrom : '';
}

function getFromGet($name)
{
  $getFrom = getFrom(INPUT_GET, $name);
  return $getFrom ? $getFrom : '';
}

function getFromSession($name)
{
  return isset($_SESSION[$name]) ? $_SESSION[$name] : '';
}

function dump($expression, $exit = true)
{
  var_dump($expression);
  if ($exit) exit(); 
}

