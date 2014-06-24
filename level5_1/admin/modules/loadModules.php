<?php
header("content-type: text/html;charset=utf-8");

$availableModules = array(
  'function',
  'mysql',
  'security'
);

foreach ($availableModules as $module)
{
  require_once realpath(__DIR__) . '/' . $module . '.php';
}