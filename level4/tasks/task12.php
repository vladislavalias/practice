<?php

// задание 12
// умножение матриц друг на друга.

$resultMultiplicate = '';
$resultMultiplicateTask12 = '';
$matrixBase = array(
  array(1, 2, 3),
  array(4, 5, 6),
  array(7, 8, 9)
);

$matrixBase2 = array(
  array(1, 2, 3),
  array(4, 5, 6),
  array(7, 8, 9)
);

for ($i = 0; $i <= count($matrixBase) - 1; $i++)
{
    for ($j = 0; $j <= count($matrixBase[$i]) - 1; $j++)
    {
        $matrixMultiplicate[$i][$j] = $matrixBase[$i][0] * $matrixBase2[0][$j]  + $matrixBase[$i][1] * $matrixBase2[1][$j] + $matrixBase[$i][2] * $matrixBase2[2][$j];
        $resultMultiplicate .=  $matrixMultiplicate[$i][$j] . ' ';
    }
        $resultMultiplicateTask12 .= $resultMultiplicate . '<br>';
        $resultMultiplicate = '';
}

echo $resultMultiplicateTask12;