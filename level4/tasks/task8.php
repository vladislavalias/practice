<?php

// задание 8
// реализовать умножение элементов матрицы выше главной диагонали на заданное число.
$resultMultiplication = '';
$resultMultiplicationTask8 = '';
$matrixBase = array(
  array(1, 2, 3),
  array(4, 5, 6),
  array(7, 8, 9)
);

for ($i = 0; $i <= count($matrixBase) - 1; $i++)
{
  for ($j = 0; $j <= count($matrixBase[$i]) - 1; $j++)
  {
    $elementMatrix = $i + $j;
    if ($elementMatrix <= 1)
    {
        $matrixBase[$i][$j] *= 3;
    }
    $resultMultiplication .= $matrixBase[$i][$j] . ' ';
  }
  $resultMultiplicationTask8 .= $resultMultiplication . '<br>';
  $resultMultiplication = '';
}

echo $resultMultiplicationTask8, '<br>';