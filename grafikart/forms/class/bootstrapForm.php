<?php

namespace Tutoriel;

class BootstrapForm extends Form
{
	/*
	 * @param $html Code HTML a entourer
	 * @return string
	 */
	protected function surround($html)
	{
		return "<div class=\"form-group\">$html</div>";
	}

	/*
	 * @param $name string
	 * @return string
	 */
	public function input($name)
	{
		return $this->surround(
			'<label>' . $name . '</label><input type="test" name="' . $name . '" value="' . $this->getValue($name) . '" class="form-control">'
		);
	}
	
	/*
	 * @return string
	 */
	public function submit()
	{
		return $this->surround('<button type="submit" class="btn btn-primary">Envoyer</button>');
	}
}

?>