<?php

if (!isAuthenticated())
{
  $errors = false;
  
  
  if (loginFormSubmitted())
  {
    $errors = loginUser();
    if(!$errors)
    {
      redirectOnPage('index.php');
    }
  }
  
  showLoginForm($errors);
  exit();
}

function showLoginForm($errors)
{
  require_once realpath(__DIR__) . '/../sign_form.php';
}

function checkPermission($module, $action)
{
  $userPermissions = unserialize($_SESSION['permission']);
//  TODO: логика по созданию ключа доступа на основании текущего запроса
//  т.е. типа ROLE_BOOK_EDIT т.е. создание строки
  if (!$module || in_array('PERMISSION_SUPER_ADMIN', $userPermissions))
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
    return getFromGet('action', 'show');
}

function isAuthenticated()
{
  return (bool)getFromSession('login');
}

function loginFormSubmitted()
{
  return getFromPostArray('login_form');
}

function isLoginFormValid()
{
  $validateData = array_intersect_key(
    (array)getFromPostArray('login_form'),
    array_flip(getLoginFormFields())
  );
  
  $cleared = array_diff($validateData, array('', false, null));
  
  return sizeof($cleared) == sizeof(getLoginFormFields());
  
  //TODO: Переделать с проверкой по ключам данных из поста на валидность
  // 
}

function loginUser()
{
  $error = '';
  $loginForm = getFromPostArray('login_form'); 
  $login = addslashes(trim($loginForm['name']));
  $pass  = trim($loginForm['pass']);
  $where = $login ? sprintf('admin="%s" AND pass="%s"', $login, md5($pass)) : 0;
  $arrayUserData = mysqlSelect('admins', '*', $where);
  $user = array_pop($arrayUserData);

  
  if ($login || $pass)
  {
      if ($user)
      {
        $_SESSION['login'] = $login;
        $_SESSION['permission'] = $user['permission'];
      }
      else
      {
        $error = 'Неправильный логин/пароль!';
      }
  }
  
  return $error;
}

function redirectOnPage($adress = '')
{
  header(sprintf('Location: /admin/%s', $adress));
}

function getLoginFormFields()
{
  return array(
      'name',
      'pass'
      );
}