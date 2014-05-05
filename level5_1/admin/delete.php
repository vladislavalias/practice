<?php
require_once 'logVerification.php';
require_once 'function.php';

mysqlDelete('id');
header("Location: http://level5_1/admin/index.php");

