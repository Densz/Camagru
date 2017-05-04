<?php
	class Personnage
	{
		const MAX_VIE= 100;

		protected $vie = 100;
		protected $atq = 20;
		protected $nom;

		public function __construct($name)
		{
			$this->nom = $name;
		}

		public function getNom()
		{
			return $this->nom;
		}
		public function getVie()
		{
			return $this->vie;
		}
		public function getAtq()
		{
			return $this->atq;
		}

		public function setNom($nom)
		{
			$this->nom = $nom;
		}
		public function setvie($vie)
		{
			$this->vie = $vie;
		}
		public function setAtq($atq)
		{
			$this->atq = $atq;
		}
		
		public function regenerer($vie = NULL)
		{
			if ($vie != NULL)
				$this->vie += $vie;
			else
				$this->vie = self::MAX_VIE;
		}

		protected function empecher_negatif()
		{
			if ($this->vie < 0)
				$this->vie = 0;
		}
		public function mort()
		{
			return $this->vie <= 0;
		}

		public function attaque($cible)
		{
			$cible->vie -= $this->atq;
			$cible->empecher_negatif();
		}
	}
?>