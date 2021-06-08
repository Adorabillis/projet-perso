<?php

namespace Controllers;

class GestionAccueilController
{
	use SessionController;

	public function __construct()
	{
		$this -> redirectIfNotAdmin();
	}
	
	public function display()
	{
		$model = new \Models\Accueil();
	    $contents = $model -> findAllContent();
        $template = 'views/back-end/gestionAccueil.phtml';
        include 'views/layout.phtml';
	}
	 
	public function displayModify()
	{
		$model = new \Models\Accueil();
	    $content = $model -> getContentById($_GET['id']);
        $template = 'views/back-end/modify/modifyHome.phtml';
        include 'views/layout.phtml';
	}
	
	//traitement du formulaire
	public function ModifySubmit()
	{
		//préparer les données pour les mettre dans la base de données
		$name = $_POST['name'];
		$description = $_POST['content'];
		$alt = $_POST['alt'];
	
		if (empty($_FILES['src']['name'])) 
		{
			$src = $_POST['imageBdd'];
		}
		else 
		{
			$image = "assets/img/{$_FILES['src']['name']}";
			move_uploaded_file ($_FILES['src']['tmp_name'], $image );
		}
		//mettre les datas en bdd
		$model = new \Models\Accueil();
		$modifyContent = $model -> modifyContent($name, $description, $src, $alt, $_GET['id']);
		header('location:index.php?page=gestionAccueil');
			exit;
	}
	
}