<?php

	namespace App;
	
	/**
	 * Class Autoloader
	 * @package  Tutoriel
	 */
	class Autoloader
	{
		/**
		 * Enregistre notre autoloader
		 */
		static function register()
		{
			spl_autoload_register(array(__CLASS__, 'autoload'));
		}

		/**
		 * Inclue le fichier correspondant à notre classe
		 * @param  $class_name string Nom de la classe à charger
		 */
		static function autoload($class_name)
		{
			if (strpos($class_name, __NAMESPACE__ . '\\') === 0)
			{
				$class = str_replace(__NAMESPACE__ . '\\', '', $class_name);
				$class = str_replace('\\', '/', $class);
				require __DIR__ . '/' . $class. '.php';	
			}
		}
	}

?>