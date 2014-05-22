<?php

function userGetAttribute($name)
{
  return getFromArray(getUser(), $name, array());
}

function userGetPermissions()
{
  return userGetAttribute('permission');
}

function userIsSuperAdmin()
{
  return false !== array_search('ROLE_SUPER_ADMIN', userGetPermissions());
}

function userCheckPermission($file, $role)
{
  if (userIsSuperAdmin()) return true;
  
  if (false !== strpos($file, '.'))
  {
    $fileExploded = explode('.', $file);
    $file         = array_shift($fileExploded); 
  }
  
  $neededPermission = sprintf('ROLE_%s_%s', strtoupper($file), strtoupper($role));
  
  return false !== array_search($neededPermission, userGetPermissions());
}

function userGetMenu()
{
  $list   = modulesGetList();
  $result = array();
  
  foreach ($list as $file)
  {
    if (userCheckPermission($file, 'show'))
    {
      $result[] = $file;
    }
  }
  
  return userMenuFormat($result);
}

function userMenuFormat($list)
{
  return implode('haha', $list);
}