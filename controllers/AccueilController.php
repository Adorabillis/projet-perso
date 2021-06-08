<?php

namespace Controllers;

class AccueilController
{
	public function display()
	{
		
		//afficher les articles de blog sur la page d'accueil
		$model1 = new \Models\Article();
		$articles = $model1 -> getNewArticles();
		$model2 = new \Models\Accueil();
	    $contents = $model2 -> findAllContent();
		//méthode qui permet d'afficher la page d'accueil
		$model = new \Models\Accueil();
		//appeler la vue 
		$template = "views/accueil.phtml";
		include 'views/layout.phtml';
	}
	
	public function displayArticle()
	{
		//"sécuriser" l'url : si on change l'url elle revient sur accueil
	
		$model = new \Models\Article();
	    $article = $model -> getArticleById($_GET['id_article']);
	    $template = 'views/article.phtml';
        include 'views/layout.phtml'; 
	}
	
	
}