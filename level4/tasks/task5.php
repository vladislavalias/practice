<?php

// задание 5
// создать компоновщик текста.
// т.е. есть некоторый набор предложений которые требуется скомпоновать в отдельный рассказ
// таким образом что бы не было повторений ранее выбранного предложения
// объекм результирующего рассказа должен быть не менее 3 предложений по не менее 5 слов в каждом.
// [ так же можно создать компоновщик предложений, смысловая нагрузка ценности не имеет ]
$resultSentense = '';
$BaseWords = array(
    array('Веня', 'Он', 'Мужик', 'Здоровяк', 'Антоха'),
    array(' ходит', ' блудит', ' ищет', ' следит', ' лелеет'),
    array(' безбожно', ' устало', ' лениво', ' богато', ' отчаянно'),
    array(' как', ' словно', ' подобно', ' не иначе как', ' без сомненья как'),
    array(' банан.', ' антрекот.', ' мизантроп.', ' идиот.', ' властелин.'),
);

for ($i = 0; $i <= count($BaseWords) - 1; $i++)
{
  $rand1 = rand(0, count($BaseWords[0]) - 1);
  $rand2 = rand(0, count($BaseWords[1]) - 1);
  $rand3 = rand(0, count($BaseWords[2]) - 1);
  $rand4 = rand(0, count($BaseWords[3]) - 1);
  $rand5 = rand(0, count($BaseWords[4]) - 1);
  $resultSentense .= ' ' . $BaseWords[0][$rand1] . $BaseWords[1][$rand2] . $BaseWords[2][$rand3] . $BaseWords[3][$rand4] . $BaseWords[4][$rand5];    
}

echo $resultSentense, '<br>';