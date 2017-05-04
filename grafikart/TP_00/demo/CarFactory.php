<?php

class CarFactory
{
	public static function getCar($type)
	{
		$type = ucfirst($type);
		$class_name = "Car$type";
		return new $class_name();
	}
}

?>