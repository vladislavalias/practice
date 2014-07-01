<?php
mysqlConnect();
function mysqlConnect()
{
  $mysql_host = '127.0.0.1';
  $mysql_login = 'root';
  $mysql_pass = 'psofroot';
  $mysql_database = 'test_books';
  
  if (!mysql_connect($mysql_host)) die('АААААААААААААААА');
  if (!mysql_select_db($mysql_database))      die('Невозможно подключиться к выбранной базе');
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

function mysqlUpdate ($table, $what, $id)
{
    foreach ($what as $key => $value)
    {
        $changes[] = sprintf('`%s`=\'%s\'', $key, addslashes($value));
    }
    $string_changes = implode(', ', $changes);
    $query = sprintf('UPDATE `%s` SET %s WHERE id=%d', $table, $string_changes, $id);
    $q = mysql_query($query);
}

function mysqlUpdateAdmin ($table, $what, $id)
{
    $rights = adminRightsTemplate();
    $what['permission'] = $rights[$what['permission']];
    foreach ($what as $key => $value)
    {
        if ($key == 'pass') 
        {
          $changes[] = sprintf('`%s`=\'%s\'', $key, md5($value));
        }
        else
        {
          $changes[] = sprintf('`%s`=\'%s\'', $key, addslashes($value));
        }
    }
    $string_changes = implode(', ', $changes);
    $query = sprintf('UPDATE `%s` SET %s WHERE id=%d', $table, $string_changes, $id);
    return mysql_query($query);
}

function mysqlDelete($table, $id)
{
    $query = sprintf('DELETE FROM `%s` WHERE id=%d', $table, $id);
    $q = mysql_query($query);
    return $q;
    //TODO: переделать так, чтобы функция возвращала TRUE только при УДАЛЕНИИ элемента,
    // а не в случае успешно выполненого запроса
}

function mysqlInsert($table, $arrayData)
{
    $data = array();
    foreach ($arrayData as $value)
    {
        $data[] = sprintf('\'%s\'', addslashes($value));
    }
    $values = implode(', ', $data);
    $arrayKeys = array_flip($arrayData);
    $keys = implode(', ', $arrayKeys);
    $query = sprintf('INSERT INTO `%s` (%s) VALUES (%s)', $table, $keys, $values);
    $q = mysql_query($query);
    return $q;
}

function mysqlInsertAdmin($table, $arrayData)
{
    $rights = adminRightsTemplate();
    $arrayData['permission'] = $rights[$arrayData['permission']];
    $data = array();
    foreach ($arrayData as $value)
    {
        $data[] = sprintf('\'%s\'', addslashes($value));
    }
    $values = implode(', ', $data);
    $arrayKeys = array_flip($arrayData);
    $keys = implode(', ', $arrayKeys);
    $query = sprintf('INSERT INTO `%s` (%s) VALUES (%s)', $table, $keys, $values);
    $q = mysql_query($query);
    return $q;
}


function mysqlAsTable($table, $names, $fields, $where, $param=0){

	$str = "select $fields from $table";
	if (!empty($where)) $str .= " where ".$where;
	// echo $str;
	$res = mysql_query($str);
	echo '
	<table id="edittable" cellspacing="0" cellpaddin="0" border="1" width="100%">
		<tr>';
	$names = explode(',', $names);
	foreach ($names as $val) {
		echo '<th>'.$val.'</th>';
		}
	echo '</tr>';
	// echo $str;
	while ($line = mysql_fetch_array($res)){
		echo '
		<tr>';
		foreach ($line as $key => $val) {
			if (is_numeric($key)) echo '<td>'.$val.'</td>';
			}
			if ($param == 1){ 
				echo '<td style="text-align:center;">
				<form action="'.$ABSPATH.'?'.$PATH.'" method="post">
					<input name="num" value="'.$line[0].'" type="hidden" />
					<input name="act" value="edit" type="hidden" />
					<input value="Редактировать" type="submit" />
				</form><br />
				<form action="'.$ABSPATH.'?'.$PATH.'" method="post">
					<input name="num" value="'.$line[0].'" type="hidden" />
					<input name="act" value="delete" type="hidden" />
					<input id="delete" value="Удалить" type="submit"  onclick=\'if (confirm("Óäàëèòü?")) return true; else return false;\' />
				</form>
				</td>
				';
			}
			echo '
		</tr>';
		}
		echo '
		</table>';
}

function updateAdmin($arrayPostData, $table, $fields = '*')
{
    //TODO: проверяем, верно ли указан старый пароль:
    // нет - сообщение об ошибке,
    // да - проверяем, совпадает ли пароль и подтверждение пароля,
    // нет - сообщение об ошибке,
    // да - вносим изменения в базу
    $where = sprintf('admin = \'%s\' AND pass = \'%s\'', $arrayPostData['admin'], md5($arrayPostData['pass']));
    $query = sprintf('SELECT %s from %s WHERE %s', $fields, $table, $where);
    if(mysql_query($query))
    {
      $where = sprintf();
    }
    else
    {
      echo 'Старый пароль введен неправильно!';
    }
}

