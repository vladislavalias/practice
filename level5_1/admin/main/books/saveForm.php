<?php
require_once 'logVerification.php';
require_once 'function.php';

// edit же
mysqlRedact('name', 'author', 'text', $id);


mysqlInsert('add_name', 'add_author', 'add_text');


//собсвенно вот и он, сюда еще можно добавить чистки и валидации но уже в таком варианте оно в принципе будет работать
//надо только поправить выборки из поста данных и усе
//но выборки у тебя уже будут многоуровневые