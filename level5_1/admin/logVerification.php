<?php

if(!$_SESSION['login'])
{
    header("Location: http://level5_1/admin/index.php");
}

