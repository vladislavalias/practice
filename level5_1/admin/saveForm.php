<?php
require_once 'logVerification.php';
require_once 'function.php';

if (getFromPost('name') || getFromPost('author') || getFromPost('text'))
{
    $query = sprintf('UPDATE books SET name="%s", author="%s", text="%s" WHERE id="%d"', getFromPost('name'), getFromPost('author'), getFromPost('text'), $id);
    $q = mysql_query($query);
}

if (getFromPost('add_name') && getFromPost('add_author') && getFromPost('add_text'))
{
    $query = sprintf('INSERT INTO books(`author`, `name`, `text`) VALUES (\'%s\', \'%s\', \'%s\')', getFromPost('add_author'), getFromPost('add_name'), trim(getFromPost('add_text')));
    $q = mysql_query($query);
    echo 'Книга успешно добавлена';
}
else
{
    if (getFromPost('add_name') || getFromPost('add_author') || getFromPost('add_text'))
    {
       echo 'Вы заполнили не все поля!';   
    }
}

//собсвенно вот и он, сюда еще можно добавить чистки и валидации но уже в таком варианте оно в принципе будет работать
//надо только поправить выборки из поста данных и усе
//но выборки у тебя уже будут многоуровневые