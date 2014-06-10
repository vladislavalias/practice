<?php

if (!isAuthenticated())
{
  $errors = false;
  
  if (loginFormSubmitted())
  {
    $errors = loginUser();
  }
  
  showLoginForm($errors);
  exit();
}

function showLoginForm($errors)
{
//  TODO: показывать форму логина.
}

function checkPermission($module, $action)
{
  $userPermissions = getUserPermissions();
//  TODO: логика по созданию ключа доступа на основании текущего запроса
//  т.е. типа ROLE_BOOK_EDIT т.е. создание строки
  
  return in_array($needPermission, $userPermissions);
}