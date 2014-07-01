<?php

$admins = mysqlSelect(getFromGet('what'));
$edit_admins = getFromPostArray(sprintf('%s_edit', getFromGet('what'))); 
$add_admins = getFromPostArray(sprintf('%s_add', getFromGet('what')));

if (getFromGet('action', 'show') == 'delete') //проверяем, была ли команда на удаление
{
    if (mysqlDelete(getFromGet('what'), getFromGet('id', 0)))
    {
        echo 'Админ удален<br />';
    }
}

if (getFromGet('action', 'show') == 'add')
{
    ?>
    <form action="index.php?what=<?php echo getFromGet('what') ?>&action=<?php echo getFromGet('action', 'show') ?>" method="post">
    Логин:<input type="text" name="<?php echo getFromGet('what') ?>_add[admin]" value="<?php echo $add_admins['admin'] ?>"><br />
    Пароль:<input type="text" name="<?php echo getFromGet('what') ?>_add[pass]" value="<?php echo $add_admins['pass'] ?>"><br />
    Права доступа: 
    <select name="<?php echo getFromGet('what') ?>_add[permission]">
      <option disabled>Выберите права</option>
      <option value="superadmin">Админ</option>
      <option value="moder">Модератор</option>
      <option value="user">Пользователь</option>
    </select><br />
    <input type="submit" value="Добавить">
    </form>
    <?php
}

if ($edit_admins['admin'] && $edit_admins['pass'] && $edit_admins['permission']) 
{
    if(mysqlUpdateAdmin(getFromGet('what'), $edit_admins, getFromGet('id', 0)))
    {
      echo 'Информация успешно изменена';
    }
}
elseif ($edit_admins) 
{
    // если были отправлены постом данные на редактирование, но есть поля пустые, возвращаем сообщение об ошибке
    echo 'Поля не могут быть пустыми!';
}

if ($add_admins['admin'] && $add_admins['pass']) 
{
    // если были отправлены постом данные на добавление и поля не пустые, добавляем в базу
    if (mysqlInsertAdmin(getFromGet('what'), $add_admins))
    {
        echo 'Админ успешно добавлен';
    }
}
elseif ($add_admins) 
{
    // если были отправлены постом данные на редактирование, но поля пустые, возвращаем сообщение об ошибке
    echo 'Поля  не могут быть пустыми!';
}

if (getFromGet('action', 'show') == 'show' || getFromGet('action', 'show') == 'delete') 
{
    foreach ($admins as $admin)
    {
        !isset($n) ? $n = 1 : $n;
        echo sprintf('%d&nbsp%s', $n, $admin['admin'])
                . '<a href="?what='.getFromGet('what').'&action=edit&id='.$admin['id'].'">Редактировать</a>'
                . '<a onclick="return confirm(\'Удалить?\');" href="?what='.getFromGet('what')
                . '&action=delete&id='.$admin['id'].'">Удалить</a>'
                . '<br />';
        $n++;
    }
    echo '<a href="?what='.getFromGet('what').'&action=add">Добавить нового админа</a>';
}

if (getFromGet('action', 'show') == 'edit')
{
    $admin = mysqlSelect(getFromGet('what'), '*', sprintf('id=%d', getFromGet('id', 1)));
    $admin ? $admin = array_pop($admin) : die('Нет такого админа!');
    ?>
    <form action="index.php?what=<?php echo getFromGet('what') ?>&action=<?php echo getFromGet('action', 'show') ?>&id=<?php echo getFromGet('id', 0) ?>" method="post">
    Логин:<input type="text" name="<?php echo getFromGet('what') ?>_edit[admin]" value="<?php echo $admin['admin'] ?>"><br />
    Новый пароль:<input type="password" name="<?php echo getFromGet('what') ?>_edit[pass]" value=""><br />
    Права доступа: 
    <select name="<?php echo getFromGet('what') ?>_edit[permission]">
      <option disabled>Выберите права</option>
      <option value="superadmin">Админ</option>
      <option value="moder">Модератор</option>
      <option value="user">Пользователь</option>
    </select><br />
    <input type="submit" value="Редактировать">
    </form>
    <?php
}



                