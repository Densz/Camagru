<?php

class Controller
{
    public static $cont;

    public function init()
    {
        $name = Routeur::$url['controller'];
        $func = $this->call_controller($name);
        $func_name = Routeur::$url['function'];
        $func->$func_name();
    }

    public function call_controller($name)
    {
       $name = 'Controller' . ucfirst($name);
       require_once('Controller/' . $name . '.class.php');
       return ($func = new $name());
    }

    public function rend($name)
    {
        extract(Controller::$cont, EXTR_OVERWRITE);
        require_once('View/' . ucfirst($name) . '.php');
    }

    public function add_buff($name)
    {
        Controller::$cont[$name] = ob_get_contents();
    }

    public function call_model($model_name)
    {
        $name = ucfirst($model_name);
        require_once('Model/' . $name . '.class.php');
        return (new $name());
    }
}

?>