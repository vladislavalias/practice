<?php
header("content-type: text/html;charset=utf-8");

session_start();
$_SESSION['login'] = '';

header('Location: index.php');
