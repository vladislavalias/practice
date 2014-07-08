<?php

function getFrom($inputType, $name, $filter = FILTER_DEFAULT, $options = FILTER_REQUIRE_SCALAR)
{
  return filter_input($inputType, $name, $filter, $options);
}

function getFromPostArray($name, $filter = FILTER_DEFAULT)
{
  return getFrom(INPUT_POST, $name, $filter, FILTER_REQUIRE_ARRAY);
}

function getFromPost($name, $default = '')
{
  $getFrom = getFrom(INPUT_POST, $name);
  return $getFrom ? $getFrom : $default;
}

function getFromGet($name, $default = '')
{
  $getFrom = getFrom(INPUT_GET, $name);
  return $getFrom ? $getFrom : $default;
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

function adminRightsTemplate ()
{
  return array(
    'superadmin' => 'a:1:{i:0;s:22:"PERMISSION_SUPER_ADMIN";}',
    'moder'      => 'a:5:{i:0;s:21:"PERMISSION_BOOKS_EDIT";i:1;s:23:"PERMISSION_AUTHORS_EDIT";i:2;s:23:"PERMISSION_AUTHORS_SHOW";i:3;s:21:"PERMISSION_BOOKS_SHOW";i:4;s:22:"PERMISSION_ADMINS_SHOW";}',
    'user'       => 'a:3:{i:0;s:23:"PERMISSION_AUTHORS_SHOW";i:1;s:21:"PERMISSION_BOOKS_SHOW";i:2;s:22:"PERMISSION_ADMINS_SHOW";}'
  );
}

function headersOut()
{
//  TODO: выводить наши насклодированные хедеры
}