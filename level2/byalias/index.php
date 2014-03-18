<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

$matrix = array(
  array(1, 2, 3, 4),
  array(4, 5, 6, 5),
  array(7, 8, 9),
);

echo print_matrix($matrix, '%.3f');
echo "\n<br />";
echo print_matrix(process_matrix($matrix));

function process_matrix($matrix)
{
  if (!$matrix) return array();
  
  $result = array();
    
  foreach ($matrix as $key => $row)
  {
    foreach ($row as $rowKey => $col)
    {
      if ($col % 2)
      {
        $col *= 4;
      }
      elseif (0 == $col % 2)
      {
        $col -= 3;
      }

      $result[$key][$rowKey] = $col;
    }
  }
  
  return $result;
}

function print_matrix($matrix, $numberFormat = '%d', $delimeter = "\n<br />")
{
  if (!$matrix) return false;
  
  $result = '';
  
  foreach ($matrix as $firstKey => $row)
  {
    $format = print_get_row_format($row, $numberFormat);
    
    $argForFunc = array_merge(array($format), $row);
    
    $result .= trim(call_user_func_array('sprintf', $argForFunc)) . $delimeter;
  }
  
  return $result;
}

function print_get_row_format($row, $format = '%.2f', $delimeter = ' ')
{
  if (!$row) return '';
  
  $result = '';
  
  foreach ($row as $key => $value)
  {
    $result .= $format . $delimeter;
  }
  
  return $result;
}