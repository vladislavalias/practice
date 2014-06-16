<?php

require_once realpath(__DIR__) . '/modules/loadModules.php';

if (!checkPermission(getModule(), getAction()))
{
  echo showPermissionError();
  exit();
}
