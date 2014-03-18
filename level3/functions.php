к<?php

function print_inputs($array)
{
  if (!$array) return false;
  
  $result = '';
  foreach ($array as $input)
  {
    $value    = print_inputs_get_value($input);
    $checked  = print_inputs_is_checked($input['type'], $input['name'], $value);
    $result   .= sprintf(
      '<input type="%s" name="%s" value="%s" %s>%s<br />'."\n",
      $input['type'],
      $input['name'],
      $value,
      $checked,
      array_key_exists('text', $input) ? $input['text'] : ''
      );
  }
  
  return $result;
}

function print_inputs_is_checked($type, $name, $value)
{
  if ('radio' != $type) return '';
  
  $post = array_key_exists($name, $_POST) ? $_POST[$name] : false;
  
  return $value == $post ? 'checked="checked"' : '';
}

function print_inputs_get_value($input)
{
  if (array_key_exists('value', $input))
  {
    $value = $input['value'];
  }
  elseif (array_key_exists($input['name'], $_POST))
  {
    $value = $_POST[$input['name']];
  }
  else
  {
    $value = '';
  }
  
  return $value;
}