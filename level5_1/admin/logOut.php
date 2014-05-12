<?php
session_start();
require_once 'function.php';

$_SESSION['login'] = 0;
header(sprintf("Location: %sindex.php", getUrl()));
