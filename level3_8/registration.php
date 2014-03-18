<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once 'function.php';
?>
<form action="registration.php" method="post"> 
  Логин: <input type="text" name="login" value="<?php echo getFromPost('login') ?>"><br />
  Пароль: <input type="password" name="pass" value=""><br />
  Повторите пароль: <input type="password" name="pass_verification" value=""><br />
  <input type="submit">
</form>
<?php
$auth  = parseData(getAllAuth('auth.pass'));
$login = getFromPost('login');
if (FALSE !== strpos($login, '='))
{
    echo 'Логин содержит недопустимый символ!';
}
else
{
    if (getFrom($auth, getFromPost('login'))) 
    {
      echo 'Такой пользователь уже зарегистрирован';
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
          addUser(getFromPost('login'), getFromPost('pass'), 'auth.pass');
        }
      }
    }
}
$logIsValid = '';
?>
<a href="index.php">Войти</a>