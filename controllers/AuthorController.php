<?php

namespace Controllers;

class AuthorController {
	
	use SessionController;
	
	public function __construct()
	{
		$this -> redirectIfNotAdmin();
		//si le formulaire a été soumis
	}

	public function display()
	{
		//afficher les auteurs
		$model = new \Models\Author();
		$authors = $model -> getAllAuthors();
        $template = 'views/back-end/gestionAuthor.phtml';
        include 'views/layout.phtml';
	}
		public function delete()
	{
		//supprimer un auteur
	    $model = new \Models\Author();
	    $model -> deleteAuthor($_GET['id']);
	}
	public function displayAdd()
	{
	    $model = new \Models\Author();
	    $authors = $model -> getAllAuthors();
    	$template = 'views/back-end/add/addAuthor.phtml';
        include 'views/layout.phtml';
	}
	
	public function AddSubmit()
	{
		//préparer les données pour les mettre dans la base de données
		$prenom = $_POST['firstname'];
		$nom = $_POST['lastname'];

		//mettre les datas en bdd
		$model = new \Models\Author();
		$model -> AddAuthor($prenom, $nom);
            
		header('location:index.php?page=gestionAuthor');
			exit;
	}
		public function displayModify()
	{
	    $model = new \Models\Author();
	    $author = $model -> findAuthorById($_GET['id']);
	    $model = new \Models\Author();
	    $authors = $model -> getAllAuthors();  
        $template = 'views/back-end/modify/modifyAuthor.phtml';
        include 'views/layout.phtml';
	}
	
	public function ModifySubmit()
	{
		//préparer les données pour les mettre dans la base de données
		$prenom = $_POST['firstname'];
		$nom = $_POST['lastname'];
		
		//mettre les datas en bdd
		$model = new \Models\Author();
		$modifyAuthor = $model -> ModifyAuthor($_GET['id'],$prenom, $nom, $id_author);
            
		header('location:index.php?page=gestionAuthor');
			exit;
	}
	
	

}