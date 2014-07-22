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
  if ($options == FILTER_REQUIRE_ARRAY && count($element) > 1)
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

/**
 * Показ действий с калькулятором
 * @param type $numbers
 * @return type
 */
function showCalculate($numbers)
{
    if (!$numbers)
    {
        return 0;
    }
    $firstElement = array_shift($numbers);
    $secondElement = array_shift($numbers);
    $result = $firstElement . $secondElement;
    if (preg_match('/[\/\*\-\+]$/', $firstElement) && preg_match('/[\/\*\-\+]$/', $secondElement))
    {
        $result = preg_replace('/[\/\*\-\+]/', $secondElement, $firstElement);
    }
    if (preg_match('/reset/', $result))
    {
        return 0;
    }
    
    $elements = explode('=', $result);
    if (count($elements) > 1)
    {
        return $elements[1] ? $elements[1] : calculate($elements[0]);
    }
    else
    {
        if(preg_match('/\d{1,}[\/\*\-\+]\d{1,}[\/\*\-\+]$/', $result))
        {
            $result = $firstElement.'= '.calculate($firstElement). $secondElement;
        }
    }
    return $result;
}

/**Вычисление значения
 * 
 * @param type $numbers
 * @return type
 */
function calculate($numbers)
{
    $result = 0;
    $elements = explode('+', $numbers);
    if (count($elements) > 1)
    {
        $result = (float)$elements[0] + (float)$elements[1];
        return $result;
    }
    $elements = explode('*', $numbers);
    if (count($elements) > 1)
    {
        $result = (float)$elements[0] * (float)$elements[1];
        return $result;
    }
    $elements = explode('/', $numbers);
    if (count($elements) > 1)
    {
        $result = (float)$elements[0] / (float)$elements[1];
        return $result;
    }
    $elements = explode('-', $numbers);
    if (count($elements) == 2)
    {
        $result = (float)$elements[0] - (float)$elements[1];
        return $result;
    }
    elseif (count($elements) == 3)
    {
        $result = 0 - (float)$elements[1] - (float)$elements[2];
        return $result;
    }
    return $numbers;
}

function calculateForm($numbers)
{
    $form_elements = array(
        array(
            array('type' => 'text', 'name' => 'calculator[show]', 'value' => showCalculate($numbers), 'readonly' => 'readonly')
        ),
        array(
            array('type' => 'submit', 'name' => 'calculator[number1]', 'value' => '1', 'readonly' => ''),
            array('type' => 'submit', 'name' => 'calculator[number2]', 'value' => '2', 'readonly' => ''),
            array('type' => 'submit', 'name' => 'calculator[number3]', 'value' => '3', 'readonly' => ''),
            array('type' => 'submit', 'name' => 'calculator[plus]', 'value' => '+', 'readonly' => '')
        ),
        array(
            array('type' => 'submit', 'name' => 'calculator[number4]', 'value' => '4', 'readonly' => ''),
            array('type' => 'submit', 'name' => 'calculator[number5]', 'value' => '5', 'readonly' => ''),
            array('type' => 'submit', 'name' => 'calculator[number6]', 'value' => '6', 'readonly' => ''),
            array('type' => 'submit', 'name' => 'calculator[minus]', 'value' => '-', 'readonly' => '')
        ),
        array(
            array('type' => 'submit', 'name' => 'calculator[number7]', 'value' => '7', 'readonly' => ''),
            array('type' => 'submit', 'name' => 'calculator[number8]', 'value' => '8', 'readonly' => ''),
            array('type' => 'submit', 'name' => 'calculator[number9]', 'value' => '9', 'readonly' => ''),
            array('type' => 'submit', 'name' => 'calculator[multuply]', 'value' => '*', 'readonly' => '')
        ),
        array(
            array('type' => 'submit', 'name' => 'calculator[reset]', 'value' => 'reset', 'readonly' => ''),
            array('type' => 'submit', 'name' => 'calculator[calculate]', 'value' => '=', 'readonly' => ''),
            array('type' => 'submit', 'name' => 'calculator[zero]', 'value' => '0', 'readonly' => ''),
            array('type' => 'submit', 'name' => 'calculator[divide]', 'value' => '/', 'readonly' => '')
        ),
    );
    
    $form = '<div style="width: 160px; margin: auto">
        <form action="index.php" method="post">
         <table>';
    
    foreach ($form_elements as $form_element_array)
    {
        $form .= '<tr>';
        foreach ($form_element_array as $form_element)
        {
            $form .= sprintf('<td colspan="'. 4/count($form_element_array).'"><input type="%s" name="%s" value="%s" %s></td>', 
                    $form_element['type'],
                    $form_element['name'],
                    $form_element['value'],
                    $form_element['readonly']);
        }
        $form .= '</tr>';
    }
               $form .= '</table>
            </form> 
         </div>';
        return $form;
}