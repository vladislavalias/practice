<?php
header("content-type: text/html;charset=utf-8");

error_reporting(E_ALL);
ini_set("display_errors", 1);

$availableModules = array(
  'function',
  'mysql',
  'security'
);

foreach ($availableModules as $module)
{
  require_once realpath(__DIR__) . '/' . $module . '.php';
}