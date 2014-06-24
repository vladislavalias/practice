<?php

//if (!isAuthenticated())
//{
//  $errors = false;
//  
//  if (loginFormSubmitted())
//  {
//    $errors = loginUser();
//  }
//  
//  showLoginForm($errors);
//  exit();
//}

function showLoginForm($errors)
{
//  TODO: показывать форму логина.
}

function checkPermission($module, $action)
{
  $userPermissions = unserialize($_SESSION['permission']);
//  TODO: логика по созданию ключа доступа на основании текущего запроса
//  т.е. типа ROLE_BOOK_EDIT т.е. создание строки
  if (!$module && !$action)
  {
      return TRUE;
  }
      
  $needPermission = sprintf('PERMISSION_%s_%s', strtoupper($module), strtoupper($action));
  return in_array($needPermission, $userPermissions);
}

function getModule()
{
    $adress = realpath(__DIR__) . sprintf('\elements\%s.php', filter_input(INPUT_GET, 'what'));
    if(file_exists($adress))
    {
        return filter_input(INPUT_GET, 'what');
    }
}

function getAction()
{
    return filter_input(INPUT_GET, 'action');
}