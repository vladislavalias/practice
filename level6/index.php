<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$arrayData = array();

for ($i = 1; $i <= 10; $i++)
{
  $arrayData[] = $i;
}

?>

<table border="1">
  <?php for ($i = 0; $i < (integer)ceil(count($arrayData) / 7); $i++): ?>
  <tr>
    <?php for ($j = 0; $j <= 6; $j++): ?>
    <td>
      <?php 
        $index = $i * 7 + $j;
        echo isset($arrayData[$index]) ? $arrayData[$index] : '';
      ?>
    </td>
    <?php endfor; ?>
  </tr>
  <?php endfor; ?>
</table>