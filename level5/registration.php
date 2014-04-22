<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once 'function.php';
mysqlConnect();

?>
<form action="registration.php" method="post"> 
  Логин: <input type="text" name="login" value="<?php echo getFromPost('login') ?>"><br />
  Пароль: <input type="password" name="pass" value=""><br />
  Повторите пароль: <input type="password" name="pass_verification" value=""><br />
  <input type="submit">
</form>
<?php
$login = getFromPost('login');
$pass = md5(getFromPost('pass'));
if (isLoginUse($login))
{
  echo 'Такой логин уже зарегистрирован в системе!';
}
else
{
  if (getFromPost('pass') != getFromPost('pass_verification'))
  {
    echo 'Пароли не совпадают!';
  }
  else
  {
    if (getFromPost('pass'))
    {
      var_dump(mysql_query('INSERT into `user` (`username`, `password`) values ("' . $login . '", "'.$pass.'")'));
    }
  }
}


$logIsValid = '';
?>
<a href="index.php">Войти</a>