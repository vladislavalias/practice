<?php
// Целое, целое, все остальное — символы
 $bindata = pack("nvc*", 0x1234, 0x5678, 65, 66);
 
 var_dump($bindata);
 
 $array=unpack("c4chars/nint", $bindata);
 
var_dump($array);