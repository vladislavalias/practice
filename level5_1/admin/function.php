<?php

require_once 'mysql.php';

function getBooks()
{
  return mysqlSelect('books');
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

function dump($values, $exit = false)
{
  var_dump($values);
  if ($exit) exit();
}