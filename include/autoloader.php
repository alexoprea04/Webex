<?php
function __autoload($class_name)
{
    preg_match('/([a-zA-Z]+)_([a-zA-Z]+)/s', $class_name, $matches);

    if(is_file($matches[2] . DIRECTORY_SEPARATOR . $matches[1] . '.php')) {
        require_once($matches[2] . DIRECTORY_SEPARATOR . $matches[1] . '.php');
    } else {
        return false;
    }
}