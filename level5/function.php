<?php
/**
 * 
 * @param type $name
 * @return type
 */

function getFromPost($name)
{
  return array_key_exists($name, $_POST) ? $_POST[$name] : '';
}

function getAllAuth($fileName)
{
  $result = '';
  $file = fopen($fileName, 'r');
  while (!feof($file))
  {
    $result .= fgets($file, 256);    
  }
  fclose($file);
  
  return $result;
}

function parseData ($data)
{
  $users = explode(PHP_EOL, $data);
  $auth = array();
  foreach ($users as $key => $value)
  {
    if(!$value)
      continue;
    
    $user = explode('=', trim($value));
    $auth[$user[0]] = $user[1];
  }
  
  return $auth;
}

function getFrom($array, $name, $default = FALSE)
{
  return array_key_exists($name, $array) ? $array[$name] : $default;
}

function addUser($login, $pass, $filename)
{
  $file = fopen($filename, 'a');
  fwrite($file, sprintf("\n%s=%s", $login, md5($pass)));
  fclose($file);
  return $file;
}

/******************************************************************************/
/*                                MYSQL FUNCTIONS                             */
/******************************************************************************/

/**
 * 
 * @return type
 */
function mysqlConnect()
{
  $mysql_host = '127.0.0.1';
  $mysql_login = 'root';
  $mysql_pass = 'psofroot';
  $mysql_database = 'test_practic';
  
  if (!mysql_connect($mysql_host, $mysql_login, $mysql_pass)) die('АААААААААААААААА');
  mysql_select_db($mysql_database);
  
  return true;
}

function logIn($login, $password)
{
  if (!$login || !$password) return FALSE;
  $query = sprintf('SELECT * from user where username="%s" and password="%s"', $login, $password);
  $result = mysql_query($query);
  $auth   = mysql_fetch_array($result);

  return $auth;
}

function isLoginUse ($login)
{
  if (!$login) return FALSE;
  $q = sprintf('SELECT * from user where username="%s"', $login);
  var_dump($q);
  $result = mysql_query($q);
  $logIsUsed = mysql_fetch_array($result);
  return $logIsUsed;
}
