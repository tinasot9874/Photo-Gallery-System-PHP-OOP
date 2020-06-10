<?php

function autoload($class){
    $class = strtolower($class);
    $the_path = "class/{$class}.php";
    if (is_file($the_path) && !class_exists($class)){
        require_once ($the_path);
    }else{
        die("This file name {$class}.php not found! ");
    }
}
spl_autoload_register('autoload');