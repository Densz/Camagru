<?php
class Form{

    private $data;
    public $surround = 'p';

    public function __construct($data = array()){
        $this->data = $data;
    }

    protected function surround($html){
        return "<{$this->surround}>{$html}</{$this->surround}>";
    } 

    public function input($name, $label, $options = [], $htmlclass = "form-control"){
        $type = isset($options['type']) ? $options['type'] : 'text';
        $label = '<label>' . $label . '</label>';
        $input = '<input class="' . $htmlclass . '" type="' . $type . '" name="' . $name . '" required=true>';
        return $this->surround($label . $input);
    }

    public function submit($name, $value = null, $htmlclass = null){
        return $this->surround('<input type="submit" name="' . $name . '" value="' . $value . '" class="' . $htmlclass . '">');
    }

}
