<?php

$edit_books = getFromPostArray('books_edit');
$add_books = getFromPostArray('books_add');
$authors = mysqlSelect('authors', 'id, firstname, secondname');

if (getFromGet('action', 'show') == 'delete') //проверяем, была ли команда на удаление
{
    if (mysqlDeleteBooks(getFromGet('what'), getFromGet('id', 0)))
    {
        echo 'Книга удалена<br />';
    }
}

$books = mysqlSelect(getFromGet('what').', `authors`', '*', 'books.author_id=authors.id');

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
    $q = mysqlUpdateBooks(getFromGet('what'), $edit_books, getFromGet('id', 1));
    echo 'Информация успешно изменена';
}
elseif ($edit_books) 
{
    // если были отправлены постом данные на редактирование, но поле имя или фамилия пустые, возвращаем сообщение об ошибке
    echo 'Поля не могут быть пустыми!';
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
    $n = 1;
    foreach ($books as $book)
    {
        echo sprintf('%d&nbsp%s&nbsp%s_%s&nbsp', $n, $book['bookname'], $book['firstname'], $book['secondname'])
                . '<a href="?what='.getFromGet('what').'&action=edit&id='.$book['book_id'].'">Редактировать</a>'
                . '<a onclick="return confirm(\'Удалить?\');" href="?what='.getFromGet('what')
                . '&action=delete&id='.$book['book_id'].'">Удалить</a>'
                . '<br />';
        $n++;
    }
    echo '<a href="?what='.getFromGet('what').'&action=add">Добавить новую книгу</a>';
}

if (getFromGet('action', 'show') == 'edit')
{
    $book = mysqlSelect(getFromGet('what'), '*', sprintf('book_id=%d', getFromGet('id', 0)));
    $book ? $book = array_pop($book) : die('Нет такой книги!');
    ?>
    <form action="index.php?what=<?php echo getFromGet('what') ?>&action=<?php echo getFromGet('action', 'show') ?>&id=<?php echo getFromGet('id', 1) ?>" method="post">
    Автор:
    <select name="<?php echo getFromGet('what') ?>_edit[author_id]">
      <?php foreach ($authors as $author): ?>
      <option value="<?php echo $author['id'] ?>" 
          <?php echo $author['id'] == $edit_books['author_id'] ? ' selected="selected"' : '' ?>>
          <?php echo sprintf('%s_%s', $author['firstname'], $author['secondname']) ?>
      </option>
      <?php endforeach; ?>
    </select><br />
    Название:<input type="text" name="<?php echo getFromGet('what') ?>_edit[bookname]" value="<?php echo $book['bookname'] ?>"><br />
    Текст:<textarea name="<?php echo getFromGet('what') ?>_edit[text]"><?php echo $book['text'] ?></textarea><br />
    <input type="submit" value="Редактировать">
    </form>
    <?php
}

