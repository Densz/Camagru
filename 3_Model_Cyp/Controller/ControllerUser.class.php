<?php

class ControllerUser extends Controller
{
    public function view()
    {
        $this->bonjour();
        echo '123<br>';
        $this->add_buff('first_var');
    }

    public function bonjour()
    {
        echo 'hello';
    }
}

?>