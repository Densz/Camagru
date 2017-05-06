<?php
namespace core;

class Autoloader{

    static function register(){
        spl_autoload_register(array(__CLASS__, 'autoload'));
    }

    static function autoload($class){
        if (strpos($class, __NAMESPACE__ . '\\') === 0){
            $class = str_replace(__NAMESPACE__ . '\\', '', $class);
            $class = str_replace('\\', '/', $class);
            require __DIR__ . '/' . $class . '.php';
        }
    }

    static function debug(){
        echo "__class = " . __CLASS__;
        echo "__NAMESPACE = " . __NAMESPACE__;
        echo "__DIR = " . __DIR__;
    }
}
