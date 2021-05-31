<?php

namespace Controllers;

class AccueilController
{
	public function display()
	{
		//afficher les articles de blog sur la page d'accueil
		$model1 = new \Models\Article();
		$articles = $model1 -> getNewArticles();
		
		//méthode qui permet d'afficher la page d'accueil
		$model = new \Models\Accueil();
		
		//appeler la vue 
		$template = "views/accueil.phtml";
		include 'views/layout.phtml';
	}
}