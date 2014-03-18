<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'function.php';

session_start();

$logName = array('admin', 'user1', 'user2');
$logPass = array('admin111', 'user111', 'user222');


if (getFromPost('login'))
{
  for ($i = 0; $i <= count($logName) - 1; $i++)
  {
    if (getFromPost('login') == $logName[$i] && getFromPost('pass') == $logPass[$i])
    {
      $_SESSION['login'] = 1;
      $_SESSION['user_name'] = $logName[$i];
    }
  }

  if (getFromSession('login'))
  {
    echo getFromSession('user_name') .' ,добро пожаловать!';
  }
  else
  {
    echo 'Неправильный логин/пароль!';
  }  
}

if (!getFromSession('login'))
{
    ?>
   <form action="index.php" method="post">
       Введите логин: <input name="login" type="text" value="" ><br />
       Введите пароль: <input name="pass" type="password" value=""><br />
       <input type="submit"> 
   </form>
   <?php   
}
