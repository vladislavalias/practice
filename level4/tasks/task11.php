<?php

// задание 11
// реализовать умножение элементов матрицы левой четверти матрицы.

$matrixBase = array(
array(1, 2, 3),
array(4, 5, 6),
array(7, 8, 9)
);
$resultTask11 = 1;

for ($i = 0; $i <= count($matrixBase) - 1; $i++)
{
    for ($j = 0; $j <= count($matrixBase[$i]) - 1; $j++)
    {
        if ($j == 0)
        {
            $resultTask11 *= $matrixBase[$i][$j];
        }
        elseif ($i == 1 && $j == 1)
        {
            $resultTask11 *= $matrixBase[1][1];
        }
    }
}

echo $resultTask11, '<br>', '<br>';