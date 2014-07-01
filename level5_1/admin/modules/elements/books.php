<?php

$edit_books = getFromPostArray('books_edit');
$add_books = getFromPostArray('books_add');
$authors = mysqlSelect('authors', 'id, firstname, secondname');

if (getFromGet('action', 'show') == 'delete') //проверяем, была ли команда на удаление
{
    if (mysqlDelete(getFromGet('what'), getFromGet('id', 0)))
    {
        echo 'Книга удалена<br />';
    }
}

$books = mysqlSelect(getFromGet('what'));

if (getFromGet('action', 'show') == 'add')
{
    ?>
    <form action="index.php?what=<?php echo getFromGet('what') ?>&action=<?php echo getFromGet('action', 'show') ?>" method="post">
    Автор:
    <select name="<?php echo getFromGet('what') ?>_add[author_id]">
      <?php foreach ($authors as $author): ?>
      <option value="<?php echo $author['id'] ?>"><?php echo sprintf('%s_%s', $author['firstname'], $author['secondname']) ?></option>
      <?php endforeach; ?>
    </select><br />
    Название книги: <input type="text" name="<?php echo getFromGet('what') ?>_add[bookname]" value="<?php echo $add_books['bookname'] ?>"><br />
    Текст:<textarea name="<?php echo getFromGet('what') ?>_add[text]"><?php echo $add_books['text'] ?></textarea><br />
    <input type="submit" value="Добавить">
    </form>
    <?php
}

if ($edit_books['author_id'] && $edit_books['bookname'] && $edit_books['text']) 
{
    // если были отправлены постом данные на редактирование и поля имя, фамилия не пустые, вносим изменения в базу
    $q = mysqlUpdate(getFromGet('what'), $edit_books, getFromGet('id', 1));
    echo 'Информация успешно изменена';
}
elseif ($edit_books) 
{
    // если были отправлены постом данные на редактирование, но поле имя или фамилия пустые, возвращаем сообщение об ошибке
    echo 'Поля Имя/Фамилия не могут быть пустыми!';
}

if ($add_books['author_id'] && $add_books['bookname'] && $add_books['text']) 
{
    // если были отправлены постом данные на добавление и поля имя, фамилия не пустые, добавляем в базу
    if (mysqlInsert(getFromGet('what'), $add_books))
    {
        echo 'Книга успешно добавлена';
    }
}
elseif ($add_books) 
{
    // если были отправлены постом данные на редактирование, но поле имя или фамилия пустые, возвращаем сообщение об ошибке
    echo 'Поля  не могут быть пустыми!';
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

