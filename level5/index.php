<?php
// как, таки заработало?)
error_reporting(E_ALL);
ini_set("display_errors", 1);

$mysql_host = '127.0.0.1';
$mysql_login = 'root';
$mysql_pass = 'psofroot';

mysql_connect($mysql_host, $mysql_login, $mysql_pass);

mysql_select_db('test_practic');

if (!mysqlSelect('SELECT * FROM test WHERE name="skoda";'))
{
  mysql_query('INSERT INTO test (name, value) VALUES ("skoda", "superb");');
}
mysql_query('UPDATE test set name = "valera" where id=2;');


var_dump(mysqlSelect('SELECT * FROM test;'));


function mysqlSelect($query)
{
  $resultQuery  = mysql_query($query);
  $result       = array();
  
  while($data = mysql_fetch_array($resultQuery)) 
  {
    $result[] = $data;
  }
  
  return $result;
}