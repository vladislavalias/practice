<?php
session_start();

if(!$_SESSION['login'])
{
    header("Location: /level5_1/admin/index.php");
}


