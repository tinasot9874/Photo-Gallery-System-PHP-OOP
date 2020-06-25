<?php

function autoload($class){

    $the_path = PATH_CLASS.DS."{$class}.php";

    if (is_file($the_path) && !class_exists($class)){
        require_once ($the_path);
    }else{
        die("This file name {$class}.php not found! ");
    }
}
spl_autoload_register('autoload');