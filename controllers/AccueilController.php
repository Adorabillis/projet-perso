<?php

namespace Controllers;

class AccueilController
{
	public function display()
	{
		//méthode qui permet d'afficher la page d'accueil
		$model = new \Models\Jeux();
		$jeux = $model -> getAllGames();
		
		//appeler la vue 
		$template = "views/accueil.phtml";
		include 'views/layout.phtml';
	}
}