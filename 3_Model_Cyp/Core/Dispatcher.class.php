<?php

class Dispatcher
{
    public function __construct()
    {
        $config = new Config();
        $routeur = new Routeur();
        $db = new Model('mysql:dbname=');
        ob_start();
        $controller = new Controller();
        $controller->init();
        ob_end_clean();
        $controller->rend(Routeur::$url['controller']);
    }
}


?>