<?php

function modulesGetList()
{
  $cleared = array_diff(scandir(realpath(__DIR__ . '/../')), array('.', '..'));
  
  return modulesGetFiles($cleared);
}

function modulesGetFiles($list)
{
  $result = array();
  foreach ($list as $one)
  {
    if (false !== strpos($one, '.php'))
    {
      $result[] = $one;
    }
  }
  
  return $result;
}

function modulesGetRoles()
{
  return array(
    'show',
    'edit',
    'new',
    'delete'
  );
}