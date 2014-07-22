<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

function getFrom($type, $name, $filter = FILTER_DEFAULT, $options = FILTER_REQUIRE_ARRAY)
{
  return filter_input($type, $name, $filter, $options);
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
        $result = preg_replace('/[\/\*\-\+]$/', $secondElement, $firstElement);
    }
    if (false !== strpos($result, 'reset'))
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

/**
 * Вычисление значения
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