<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
session_start();

require_once realpath(__DIR__) . '/modules/loadModules.php';

ob_start();
require_once 'templates/layout.php';
$buffer = ob_get_contents();
ob_end_clean();

headersOut();
echo $buffer;