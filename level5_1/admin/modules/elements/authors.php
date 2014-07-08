<?php


$edit_authors = getFromPostArray('authors_edit');
$add_authors = getFromPostArray('authors_add');

if (getFromGet('action', 'show') == 'delete') //проверяем, была ли команда на удаление
{
    if (mysqlDelete(getFromGet('what'), getFromGet('id', 0)))
    {
        header('Location: index.php?what=authors&action=show');
    }
}

$authors = mysqlSelect(getFromGet('what'));

if (getFromGet('action', 'show') == 'add')
{
    ?>
    <form action="index.php?what=<?php echo getFromGet('what') ?>&action=<?php echo getFromGet('action', 'show') ?>" method="post">
    Имя:<input type="text" name="<?php echo getFromGet('what') ?>_add[firstname]" value="<?php echo $add_authors['firstname'] ?>"><br />
    Фамилия:<input type="text" name="<?php echo getFromGet('what') ?>_add[secondname]" value="<?php echo $add_authors['secondname'] ?>"><br />
    Биография:<textarea name="<?php echo getFromGet('what') ?>_add[info]"><?php echo $add_authors['info'] ?></textarea><br />
    <input type="submit" value="Добавить">
    </form>
    <?php
}

if ($edit_authors['firstname'] && $edit_authors['secondname']) 
{
    // если были отправлены постом данные на редактирование и поля имя, фамилия не пустые, вносим изменения в базу
    $q = mysqlUpdate(getFromGet('what'), $edit_authors, getFromGet('id', 1));
    echo 'Информация успешно изменена';
}
elseif ($edit_authors) 
{
    // если были отправлены постом данные на редактирование, но поле имя или фамилия пустые, возвращаем сообщение об ошибке
    echo 'Поля Имя/Фамилия не могут быть пустыми!';
}

if ($add_authors['firstname'] && $add_authors['secondname']) 
{
    // если были отправлены постом данные на добавление и поля имя, фамилия не пустые, добавляем в базу
    if (mysqlInsert(getFromGet('what'), $add_authors))
    {
        echo 'Автор успешно добавлен';
    }
}
elseif ($add_authors) 
{
    // если были отправлены постом данные на редактирование, но поле имя или фамилия пустые, возвращаем сообщение об ошибке
    echo 'Поля Имя/Фамилия не могут быть пустыми!';
}

if (getFromGet('action', 'show') == 'show' || getFromGet('action', 'show') == 'delete') 
{
    foreach ($authors as $author)
    {
        !isset($n) ? $n = 1 : $n;
        echo sprintf('%d&nbsp%s_%s&nbsp', $n, $author['firstname'], $author['secondname'])
                . '<a href="?what='.getFromGet('what').'&action=edit&id='.$author['id'].'">Редактировать</a>'
                . '<a onclick="return confirm(\'Удалить?\');" href="?what='.getFromGet('what')
                . '&action=delete&id='.$author['id'].'">Удалить</a>'
                . '<br />';
        $n++;
    }
    echo '<a href="?what='.getFromGet('what').'&action=add">Добавить нового автора</a>';
}

if (getFromGet('action', 'show') == 'edit')
{
    $author = mysqlSelect(getFromGet('what'), '*', sprintf('id=%d', getFromGet('id', 1)));
    $author ? $author = array_pop($author) : die('Нет такого автора!');
    ?>
    <form action="index.php?what=<?php echo getFromGet('what') ?>&action=<?php echo getFromGet('action', 'show') ?>&id=<?php echo getFromGet('id', 1) ?>" method="post">
    Имя:<input type="text" name="<?php echo getFromGet('what') ?>_edit[firstname]" value="<?php echo $author['firstname'] ?>"><br />
    Фамилия:<input type="text" name="<?php echo getFromGet('what') ?>_edit[secondname]" value="<?php echo $author['secondname'] ?>"><br />
    Биография:<textarea name="<?php echo getFromGet('what') ?>_edit[info]"><?php echo $author['info'] ?></textarea><br />
    <input type="submit" value="Редактировать">
    </form>
    <?php
}

