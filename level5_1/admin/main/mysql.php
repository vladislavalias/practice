<?php

$mysqlConnected = isset($mysqlConnected) ? : FALSE; 

function mysqlConnect()
{
  GLOBAL $mysqlConnected;
  if ($mysqlConnected) 
  {
    return TRUE;
  }
  $mysql_host = '127.0.0.1';
  $mysql_login = 'root';
  $mysql_pass = 'psofroot';
  $mysql_database = 'test_books';
  if (!mysql_connect($mysql_host)) die('АААААААААААААААА');
  mysql_select_db($mysql_database);
  mysql_query("SET NAMES UTF8") or die('DDDDDD');
  mysql_query("SET CHARACTER SET UTF8") or die('DDDDDD2'); 
  
  return $mysqlConnected = true;
}

function mysqlSelect($table, $fields = '*', $where = '1')
{
  mysqlConnect();
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

function mysqlInsert($name, $author, $text)
{
     mysqlConnect();
     if (getFromPost($name) && getFromPost($author) && getFromPost($text))
    {
        $query = sprintf('INSERT INTO books(`author`, `name`, `text`) VALUES (\'%s\', \'%s\', \'%s\')', getFromPost($name), getFromPost($author), trim(getFromPost($text)));
        $q = mysql_query($query);
        echo 'Книга успешно добавлена';
    }
    else
    {
        if (getFromPost($name) || getFromPost($author) || getFromPost($text))
        {
           echo 'Вы заполнили не все поля!';   
        }
    }
}

function mysqlRedact($name, $author, $text, $id) 
{
    mysqlConnect();
    if (getFromPost($name) || getFromPost($author) || getFromPost($text))
    {
        $query = sprintf('UPDATE books SET name="%s", author="%s", text="%s" WHERE id="%d"', getFromPost($name), getFromPost($author), getFromPost($text), $id);
        $q = mysql_query($query);
    }
}

function mysqlDelete($id)
{
    mysqlConnect();
    if (getFromGet($id))
    {
        $query = sprintf('DELETE from books where id="%d"', getFromGet($id));
        $q = mysql_query($query);
    }
}