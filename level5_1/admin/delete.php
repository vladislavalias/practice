<?php
require_once 'logVerification.php';
require_once 'function.php';

if (getFromGet('id'))
{
    $query = sprintf('DELETE from books where id="%d"', getFromGet('id'));
    $q = mysql_query($query);
}
header("Location: http://level5_1/admin/index.php");

