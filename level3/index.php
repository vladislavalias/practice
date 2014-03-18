<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'functions.php';

// задание 1 ****
// написать калькулятор
// вводные данные - любые числа, соответственно должны обрабатываться ошибки со строками
// операция должна задаваться радиобаттонами, реализуемые операции
// умножить, сложить, вычесть, разделить, корень, квадрат, и возведение в степень Н
// дополнение: после, реализовать выполнение любой последовательности вычислений,
// но при этом, фильтровать от неверного ввода

?>
<form action="index.php" method="post">
    <input type="text" size="18" name="arg1" value="<?php echo  $_POST['arg1']  ?>"><br />
    <input type="radio" name="operation" value="+" <?php echo $_POST['operation'] == '+' ?  'checked= "checked"' : '' ?>>+<br />
    <input type="radio" name="operation" value="-" <?php echo $_POST['operation'] == '-' ?  'checked="checked"' : '' ?>>-<br />
    <input type="radio" name="operation" value="*" <?php echo $_POST['operation'] == '*' ?  'checked="checked"' : '' ?>>*<br />
    <input type="radio" name="operation" value="/" <?php echo $_POST['operation'] == '/' ?  'checked="checked"' : '' ?>>/<br />
    <input type="radio" name="operation" value="sqrt" <?php echo $_POST['operation'] == 'sqrt' ?  'checked="checked"' : ''?>>sqrt<br />
    <input type="radio" name="operation" value="^" <?php echo $_POST['operation'] == '^' ? 'checked="checked"' : ''?>>^<br />
    <input type="text" size="18" name="arg2" value="<?php echo  $_POST['arg2']  ?>"><br />
    <input type="submit" value="Посчитать"> <br />
    Результат: 
    <?php 
    if (ctype_digit($_POST['arg1']) == false || ctype_digit($_POST['arg2']) == false) 
{
    $resultOper = 'error';
}
 else 
{
         if ($_POST['operation'] == '+')
     {
         $resultOper = $_POST['arg1'] + $_POST['arg2'];
     }
         elseif ($_POST['operation'] == '-') 
     {
          $resultOper = $_POST['arg1'] - $_POST['arg2'];
     }

         elseif ($_POST['operation'] == '*') 
     {
          $resultOper = $_POST['arg1'] * $_POST['arg2'];
     }

         elseif ($_POST['operation'] == '/') 
     {
          $resultOper = $_POST['arg1'] / $_POST['arg2'];
     }
         elseif ($_POST['operation'] == '^') 
     {
          $resultOper = exp($_POST['arg2']*log($_POST['arg1']));
     }
         elseif ($_POST['operation'] == 'sqrt') 
     {
          $resultOper = sqrt($_POST['arg1']);
     }
}
 

    echo $resultOper;
?>
</form>
<?php

// задание 2 *****
// есть входная строка "asdddfghhhjklll"
// требуется убрать из нее все повторения символов
// так же должна быть корректная обработка пробелов на удаление повторений
// дополнение - реализовать два метода.

$string = "asdddfghhhjkllladfghaaaaa";
//         asdfghjkladfgh
$result = $string[0];

echo $string . '<br />';

for ($i = 1; $i <= strlen($string) - 1; $i++)
{
  if ($string[$i] != $string[$i - 1])
  {
    $result = $result . $string[$i];
  }
}
echo $result;
echo '<br>';

$result = '';
for ($i = 0; $i <= strlen($string) - 1; $i++)
{
  if ($i == strpos($string, $string[$i]))
  {
    $result .= $string[$i];
  }
}

echo $result . '<br />';

//for ($i = 0; $i <= strlen($result) - 1; $i++)
//{
//
//    $pos = strpos($string, $string[$i], 0);
//    $max = strlen($result) - 1;
//
//    if (substr_count($result, $result[$i]) == 1)
//    {
//     echo $result[$i];   
//    }
//    else
//    {
//        if ($pos < $max)
//        {
//            $max = $pos; 
//            echo $result[$i];
//        }
//        else
//        {
//            continue;
//        }
//    }
//}
echo '<br>';

// задание 3 **
// реализовать вычисление длины окружности по задаваемом в форме радиусу

?>

<form action="index.php" method="post">
Радиус окружности: <input type="text" size="18" name="radius" value="<?php echo $_POST['radius'] ?>">
<input type="submit"> <br />
Длина окружности: 
<?php
  $result = 2 * M_PI * $_POST['radius'];
  echo sprintf('%.2f', $result);
?>   
</form>

<?php

// задание 4 *
// есть список песен {1, 2, 3, 4, 5}
// реализовать произвольный выбор одной из них

$playlist = array('wind of change', 'sonne', 'new people', 'johnny be good', 'show must go on');
$n = rand(0, count($playlist) - 1);
echo $playlist[$n];
echo '<br>';

// задание 5 *
// есть массив чисел {5, 6, 9, 2, 4, 0}
// реализовать сортировку массива по возрастанию и по убыванию
// результат и исходный массив выводить на экран
// в качестве бонуса можно сделать переключатель - выбор направления сортировки

$array = array(5, 6, 9, 2, 4, 0);
while (list($key, $val) = each($array)) 
{
    echo "$val", ' ';
}
echo '<br>';
?>
<form action="index.php" method="post">
    <input type="radio" name="way" value="+">+<br>
    <input type="radio" name="way" value="">-<br>
    <input type="submit">
</form>

<?php


echo '<br>';

if ($_POST['way'] == '+')
{
    sort($array);
    reset($array);
    while (list($key, $val) = each($array)) 
    {
        echo "$val", ' ';
    }  
}
else
{
    rsort($array);
    reset($array);
    while (list($key, $val) = each($array)) 
    {
        echo "$val", ' ';
    }
}
// задание 6 ****
// реализовать форматер текущей даты
// должна быть форма с выбором требуемого формата вывода даты
// и соответственно вывод ее в выбранном формате
// минимум 7 форматов, в виде год/месяц/день часы:минуты:секунды
// к этому можно добавить дни недели, названия месяцев и ведущие нули в цифрах
// 13/12/02
// 2013-12-2
// 02 December 2013
// 02 Dec 2013
// 02 Mon Dec 2013

$time = '11/16/2001 20:15:58';
$time2 = preg_replace('/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})/ui', '$3-$2-$1',$time);
echo $time2, '<br>';
echo date('y-F-d H:i:s');
echo date('d F Y G:i:s'), '<br>';
echo date('j.m.y g/i/s'), '<br>';
echo date('j n y G:i:s'), '<br>';
echo date('r'), '<br>';
echo date('l, d F G:i:s'), '<br>';
echo date('d M Y h:i:s'), '<br>';
echo date('d m Y g:i:s'), '<br>';

?>
<form action="index.php" method="post">
<input type="text" size="18" name="number5" value="
<?php 
    $resu1tOperations = 0;
    $argumen1s = $_POST['number5'];
    $argumentsForCalc = preg_replace("/(\d{1,})(\D)(\d{1,})/", "\\1 \\2 \\3", $argumen1s);
    $massiveArgForCalc = explode(' ', $argumentsForCalc);
    if($temp = explode('+', $argumen1s))
    {
      echo  sizeof($temp) > 1 ? 'YEAH!' : '';
    }
    if($massiveArgForCalc[1] == '+')
    {
        $resu1tOperations = $massiveArgForCalc[0] + $massiveArgForCalc[2];
    }
    
    elseif($massiveArgForCalc[1] == '-')
    {
        $resu1tOperations = $massiveArgForCalc[0] - $massiveArgForCalc[2];
    }
    
    elseif($massiveArgForCalc[1] == '*')
    {
        $resu1tOperations = $massiveArgForCalc[0] * $massiveArgForCalc[2];
    }
    
    elseif($massiveArgForCalc[1] == '/')
    {
        $resu1tOperations = $massiveArgForCalc[0] / $massiveArgForCalc[2];
    }
    
        echo $_POST['number5'], '=', $resu1tOperations;
?>
"><br />
<input type="submit" value="Посчитать"> <br>
</form>

<form action="index.php" method="post">
<input type="text" size="18" name="number4" value="
<?php 
    $resulted = 0;
    $arguments = $_POST['number4'];
    $massiveArg = explode('+', $arguments);
    foreach ($massiveArg as $key => $numbers)
    {
        $resulted += $numbers;
    }
    echo $_POST['number4'], '=', $resulted;
?>
"><br />
<input type="submit" value="Посчитать"> <br>
</form>

<?php 
//  eval(sprintf('$resulted = %s;', $_POST['number10']));
?>

<form action="index.php" method="post">
<input type="text" size="18" name="number10" value="<?php echo $_POST['number10'] ?>"><br />
<input type="submit" value="Посчитать"> <br>
Результат: <?php echo $resulted ?>
</form>