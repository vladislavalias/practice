<?php

function getFromPost($name, $default = FALSE)
{
   return array_key_exists($name, $_POST) ? $_POST[$name] : $default;
}

function getFromSession ($name, $default = FALSE)
{
    return array_key_exists($name, $_SESSION) ? $_SESSION[$name] : $default;
}