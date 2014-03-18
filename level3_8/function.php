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