<?php
namespace Tutoriel;
/*
 * Class Form
 * Permet de générer un formulaire rapidement et simplement
 */
class Form
{
	/*
	 * @var array Données utilisées par le formulaire
	 */
	protected $_data;

	/*
	 * @var string Tag utilisé pour entourer les champs
	 */
	public $surround = 'p';

	/*
	 * @param array $data Données utilisées par le formulaire
	 */
	public function __construct($data = array())
	{
		$this->_data = $data;
	}

	/*
	 * @param $html Code HTML a entourer
	 * @return string
	 */
	protected function surround($html)
	{
		return "<{$this->surround}>$html</{$this->surround}>";
	}

	/*
	 * @param $index string Index de la valeur a récupérer
	 * @return string
	 */
	protected function getValue($index)
	{
		return isset($this->_data[$index]) ? $this->_data[$index] : NULL;
	}

	/*
	 * @param $name string
	 * @return string
	 */
	public function input($name)
	{
		return $this->surround(
			'<input type="test" name="' . $name . '" value="' . $this->getValue($name) . '">'
		);
	}

	/*
	 * @return string
	 */
	public function submit()
	{
		return $this->surround('<button type="submit">Envoyer</button>');
	}
}

?>