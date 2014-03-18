<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
mb_internal_encoding('UTF-8');
session_start();

require_once 'function.php';

if (getFromPost('task'))
{
    $_SESSION['task'] = getFromPost('task');
}
if (!isset($_SESSION[getFromSession('task').'_showed'])) 
{
  $_SESSION[getFromSession('task').'_showed'] = 1;
} 
else 
{
  $_SESSION[getFromSession('task').'_showed']++;
}

echo 'Задание '.getFromSession('task').' было продемонстировано ', $_SESSION[getFromSession('task').'_showed'], ' раз(а)';
$availableTask = array(
  'task1',  'task2',  'task3',
  'task4',  'task5',  'task6',
  'task7',  'task8',  'task9',
  'task10', 'task11', 'task12'
);

// первое требование к заданию, это реализовать выбор какое именно сейчас требуется продемонстрировать
// т.е. реализовать селект с выбором номера задания которое сейчас будет запущено и показано
// но!!! в данном индекс файле реализации выбранного задания быть не должно
// а должен быть только выбор
?>

<form action="index.php" method="post">
    <select name="task">
      <?php foreach ($availableTask as $task): ?>
        <?php $selected = $task == getFromSession('task') ? ' selected="selected"' : '' ?>
        <?php echo sprintf('<option value="%s"%s>%s</option>', $task, $selected, ucfirst($task)) ?>
      <?php endforeach; ?>
    </select>    
    <p><input type="submit" value="Показать"></p>
</form>
<?php

if (in_array(getFromSession('task'), $availableTask))
{
  include_once "tasks/".$_SESSION['task'].".php";
}
else 
{
  echo 'Такого задания нет!';
}
// ремарочка - не должно быть в выводе страницы ни нотисов ни ворнингов ни ошибок
// дополнительно (желательно, но не обязательно) - []
// [ показывать вверху перед выбором одной строчкой количество демонстрации
// данного задания, в формате "Задание %name% было продемонстрировано %n% кол-во раз" ]
// [ реализовать конструктор эл-тов формы ]





 














