<?php

// задание 7
// расчет номеров последующих после текущего высокосных годов на 50 лет вперед.

$year = date('Y');
$resultTask7 = '';

for ($i = $year; $i <= $year + 50; $i++)
{
  if ($i % 4 == 0)
  {
    $resultTask7 .= $i . '<br>';
  }
}

echo $resultTask7;