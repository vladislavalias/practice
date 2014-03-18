<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

$stringBase = 'aaacccccddddddddddd                          dddbbc';

$max = '';
$result = $stringBase[0];

for ($i = 0; $i < strlen($stringBase) - 1; $i++)
{
  if (' ' == $stringBase[$i])    continue;
  
  if ($stringBase[$i] == $result[0])
  {
    $result = $result . $stringBase[$i];
  }
  else 
  {
    if (strlen($result) > strlen($max))
    {
      $max = $result;
    }
    $result = $stringBase[$i];
  }
}

echo $max;


exit();

$stringBase = 'ggggggffffffffhhhhhhjjjjkkkkkk  Kkkkkkkk';
$word = '';

$strElement = $stringBase[0];
for ($i = 0; $i < strlen($stringBase) - 1; $i++)
{
  if ($stringBase[$i] == $strElement)
  {
    $word .= $strElement . $stringBase[$i];
  }
  else 
  {
    $strElement = $stringBase[$i];
  }
}
echo $word;
        
exit();

$stringBase = 'ghjgj gjhgjhgjhg ghjghj ghjgj';
$words = explode (' ', $stringBase);

$max = '';
foreach ($words as $key => $word)
{
  if (strlen($word) > strlen($max))
  {
    $max = $word;
  }
}

echo $max;

