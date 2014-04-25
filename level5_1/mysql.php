<<<<<<< HEAD
<?php
mysqlConnect();
function mysqlConnect()
{
  $mysql_host = '127.0.0.1';
  $mysql_login = 'root';
  $mysql_pass = 'psofroot';
  $mysql_database = 'test_books';
  
  if (!mysql_connect($mysql_host)) die('АААААААААААААААА');
  mysql_select_db($mysql_database);
  mysql_query("SET NAMES UTF8") or die('DDDDDD');
  mysql_query("SET CHARACTER SET UTF8") or die('DDDDDD2'); 
  return true;
}

/**
 * 
 * @param type $table Название таблицы
 * @param type $fields
 * @param type $where
 */
function mysqlSelect($table, $fields = '*', $where = '1')
{
  $fields = is_string($fields) ? $fields : implode(',', $fields);
  $query = sprintf('SELECT %s FROM %s WHERE %s', $fields, $table, $where);
  $q = mysql_query($query);
  $result = array();
  while ($data = mysql_fetch_array($q)) 
  {
    $result[] = $data;
  }
  
  return $result; 
}

function mysqlSelectOne($table, $fields = '*', $where = '1')
{
  $result = mysqlSelect($table, $fields, $where);
  
  return 1 == sizeof($result) ? array_shift($result) : $result; 
}

function getTextFromSql($table, $id)
{
  return mysqlSelectOne($table, '*', sprintf('id = %s', $id));
=======
<?php
mysqlConnect();
function mysqlConnect()
{
  $mysql_host = '127.0.0.1';
  $mysql_login = 'root';
  $mysql_pass = 'psofroot';
  $mysql_database = 'test_books';
  
  if (!mysql_connect($mysql_host, $mysql_login, $mysql_pass)) die('АААААААААААААААА');
  mysql_select_db($mysql_database);
  mysql_query("SET NAMES UTF8") or die('DDDDDD');
  mysql_query("SET CHARACTER SET UTF8") or die('DDDDDD2'); 
  return true;
}

/**
 * 
 * @param type $table Название таблицы
 * @param type $fields
 * @param type $where
 */
function mysqlSelect($table, $fields = '*', $where = '1')
{
  $fields = is_string($fields) ? $fields : implode(',', $fields);
  $query = sprintf('SELECT %s FROM %s WHERE %s', $fields, $table, $where);
  $q = mysql_query($query);
  $result = array();
  while ($data = mysql_fetch_array($q)) 
  {
    $result[] = $data;
  }
  
  return $result; 
}

function mysqlSelectOne($table, $fields = '*', $where = '1')
{
  $result = mysqlSelect($table, $fields, $where);
  
  return 1 == sizeof($result) ? array_shift($result) : $result; 
}

function getTextFromSql($table, $id)
{
  return mysqlSelectOne($table, '*', sprintf('id = %s', $id));
>>>>>>> c8eab4a86cdd9c0b7fc602e795928d4a805e3eb3
}