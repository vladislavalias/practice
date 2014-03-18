<?php

// значит есть допустим список фильмов (заполнить по выбору штук 20)
// индекс страница должна показывать некоторое их количество
// почему некоторое? хаха) потому что должно быть две фичи
// первая количество фильмов на странице, вторая страница для показа
// например страница 1 показывает 5 фильмов - соответственно страниц будет 4
// где на первой будут первые пять результатов
// переход по страницам сделать с помощью ссылки
// количество результатов на странице сделать с помощью инпута и сохранять его скажем в сессию
// так же показывать общее количество доступных для просмотра страниц
// основываясь на текущем количестве для показа на одной

function calculateBLEATALL($array)
{
  $result = array();
  foreach ($array as $one)
  {
    $result[] = calculate($one);
  }
  
  return $result;
}

function calculate($what)
{
  $function = sprintf('calculate%s', ucfirst($what[1]));
  
  return $function($what[0], $what[2]);
}

function calculatePow($number, $pow)
{
  return pow($number, $pow);
}

function calculatePlu($addWhat, $addTo)
{
  return $addWhat + $addTo;
}

function calculateDev($devWhat, $devTo)
{
  return $devWhat / $devTo;
}

function calculateSub($subWhat, $subTo)
{
  return $subWhat - $subTo;
}

function calculateMul($mulWhat, $mulTo)
{
  return $mulWhat * $mulTo;
}