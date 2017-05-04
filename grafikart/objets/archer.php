<?php

	class Archer extends Personnage
	{
		protected $vie = 40;
		public function __construct($nom)
		{
			$this->vie /= 2;
			parent::__construct($nom);
		}

		public function attaque($cible)
		{
			$cible->vie -= $this->atq;
			parent::attaque($cible);
		}
	}
?>