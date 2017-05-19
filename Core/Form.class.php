<?php
class Form
{
    private $data;
    public $surround = 'p';

    public function __construct($data = array())
    {
        $this->data = $data;
    }

    protected function surround($html)
    {
        return "<{$this->surround}>{$html}</{$this->surround}>";
    } 

    public function input($name, $label, $options = [], $htmlclass = "form-control", $require = 'true')
    {
        $type = isset($options['type']) ? $options['type'] : 'text';
        $label = '<label>' . $label . '</label>';
        $input = '<input class="' . $htmlclass . '" type="' . $type . '" name="' . $name . '" required=' . $require . '>';
        return $this->surround($label . $input);
    }

    public function submit($name, $value = null, $htmlclass = null)
    {
        return $this->surround('<input type="submit" name="' . $name . '" value="' . $value . '" class="' . $htmlclass . '">');
    }

    public function img($src, $className = null, $alt = null)
    {
        $img = '<img src="' . $src . '" class="' . $className . '"';
        if (CB::my_assert($alt))
            $img .= 'alt="' . $alt . '"';
        $img .= '>';
        return $this->surround($img);
    }

}
