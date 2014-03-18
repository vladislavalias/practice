<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'function.php';

$calculateTo = array (
  array (2, 'pow', 6),
  array (2, 'plu', 5),
  array (4, 'dev', 2),
  array (21, 'dev', 3),
  array (6, 'sub', 8),
  array (3, 'dev', 7),
  array (23, 'sub', 5),
  array (11, 'sub', 22),
  array (8, 'dev', 8),
  array (4, 'sub', 4),
  array (3, 'mul', 9),
  array (6, 'mul', 20),
  array (22, 'dev', 23),
  array (4, 'mul', 23),
  array (7, 'plu', 5),
  array (6, 'plu', 6),
  array (8, 'dev', 3),
  array (9, 'dev', 9),
  array (3, 'plu', 4),
  array (6, 'mul', 5),
  array (3, 'plu', 8),
  array (2, 'plu', 2),
);

echo implode("\n<br />", calculateBLEATALL($calculateTo));

