<?php
require_once 'logVerification.php';
require_once 'function.php';

mysqlDelete('id');
header(sprintf("Location: %sindex.php", getUrl()));

