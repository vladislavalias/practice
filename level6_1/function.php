<?php

function getFrom($type, $name, $filter = FILTER_DEFAULT, $options = FILTER_REQUIRE_ARRAY)
{
  return filter_input($type, $name, $filter, $options);
}

function getFromPost($name, $options = FILTER_REQUIRE_SCALAR)
{
  $element = explode('.', $name, 2);
  if(count($element) == 2 && $options == FILTER_REQUIRE_SCALAR)
  {
    return getFromPost($name, FILTER_REQUIRE_ARRAY);
  }

  $getFrom = getFrom(INPUT_POST, $element[0], FILTER_DEFAULT, $options);
  if ($options == FILTER_REQUIRE_ARRAY)
  {
    $getFrom = $getFrom[$element[1]];
  }
  return $getFrom ? $getFrom : '';
}

function getFromPostTest($name, $options = FILTER_REQUIRE_SCALAR, $array = array())
{
  $element = explode('.', $name, 2);
  $result = false;
  
  if (1 == sizeof($element))
  {
    if ($array)
    {
      $result = isset($array[$element[0]]) ? $array[$element[0]] : false;
    }
    else
    {
      $result = getFromTest(INPUT_POST, $element[0], FILTER_DEFAULT, $options);
    }
    
    return $result; 
  }
  
  if (1 != sizeof($element))
  {
    if (!$array)
    {
      $array = getFromTest(INPUT_POST, $element[0], FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
    }
    
    $array  = isset($array[$element[0]]) ? $array[$element[0]] : $array;
    $result = getFromPostTest($element[1], $options, $array);
  }
  
  return $result;
}


function getFromPostRecursive($name, $option = FILTER_REQUIRE_SCALAR)
{
  $keys           = explode('.', $name, 2);
  $filterOptions  = (1 == sizeof($keys) ? $option : FILTER_REQUIRE_ARRAY);
  $array = array(
    $keys[0] => getFrom(INPUT_POST, $keys[0], FILTER_DEFAULT, $filterOptions)
  );
  
  return getFromRecursion($name, $array, NULL);
}

function getFromRecursion($name, $array, $default = false)
{
  $keys = explode('.', $name, 2);
  
  if (1 == sizeof($keys))
  {
    return isset($array[$keys[0]]) ? $array[$keys[0]] : $default;
  }
  
  if (1 !== sizeof($keys))
  {
    $lastArray = isset($array[$keys[0]]) ? $array[$keys[0]] : array();
    
    return getFromRecursion($keys[1], $lastArray, $default);
  }
}

function dump($value, $exit = true)
{
  var_dump($value);
  if ($exit) exit();
}