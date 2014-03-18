<?php

$matrix = array
(
  array (1, 2, 3, 4 ),
  array (4, 5, 6, 4),
  array (7, 8, 9, 4),
  array (7, 8, 9, 4),
);
        
foreach ($matrix as $key => $raw)
{
  foreach ($raw as $rawKey => $col)
  {
    echo $col, " ";
  }
  echo '<br />';
}

echo '<br>';

foreach ($matrix as $key => $raw)
{
  foreach ($raw as $rawKey => $col)
  {
    if ($col % 2) 
    {
      $col *= 4;
    }
    else 
    {
      $col -= 3;
    }
    
    $matrix[$key][$rawKey] = $col;
  }
}

echo '<br>';

foreach ($matrix as $key => $raw)
{
  foreach ($raw as $rawKey => $col)
  {
    echo $col, " ";
  }
  echo '<br />';
}

exit();

$matrix1 = array (1, 2, 3);
$matrix2 = array (2, 3, 4);
$matrix3 = array (5, 6, 7);

foreach ($matrix1 as $key => $col)
{
  echo $col, " ";
}

echo "<br>";

foreach ($matrix2 as $key => $col){

  echo $col, " ";
}

echo '<br />';

foreach ($matrix3 as $key => $col){

  echo $col, " ";
};

echo "<br>";
echo "<br>";

foreach ($matrix1 as $key => $col)
{
  if ($col % 2)
  {
    echo $col * 4, " ";
  }
  else
  {
    echo $col - 3, " ";
  }
}

echo "<br>"; 

foreach ($matrix2 as $key => $col){
if ($col % 2)
  echo $col * 4, " ";
else echo $col - 3, " ";
}

echo "<br>";

foreach ($matrix3 as $key => $col){
if ($col % 2)
  echo $col * 4, " ";
else echo $col - 3, " ";
}

echo "<br>";

