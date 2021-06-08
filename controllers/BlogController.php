<?php

namespace Controllers;

class BlogController {
	
	use SessionController;
	
	public function __construct()
	{
		$this -> redirectIfNotAdmin();
		//si le formulaire a été soumis
	}
	
	public function display()
	{
		//afficher les articles
		$model = new \Models\Category();
		$categories = $model -> getAllCategory();
		$model1 = new \Models\Article();
		$articles = $model1 -> getAllArticles();
        $template = 'views/back-end/gestionArticle.phtml';
        include 'views/layout.phtml';
	}
		public function delete()
	{
	    $model = new \Models\Article();
	    $model -> deleteArticle($_GET['id_article']);
	}
	public function displayAdd()
	{
	    $model = new \Models\Category();
	    $categories = $model -> getAllCategory();
	    $model1 = new \Models\Author();
	    $authors = $model1 -> getAllAuthors();
        $template = 'views/back-end/add/addArticle.phtml';
        include 'views/layout.phtml';
	}
	
	public function AddSubmit()
	{
		//préparer les données pour les mettre dans la base de données
		$categorie = $_POST['category'];
		$author = $_POST['author'];
		$title = $_POST['title'];
		$description = $_POST['texte'];
		$src = "assets/img/{$_FILES['src']['name']}";
		$alt = $_POST['alt'];
		
		//upload mon image
		move_uploaded_file ($_FILES['src']['tmp_name'], $src);
		
		//mettre les datas en bdd
		$model = new \Models\Article();
		$model -> AddArticle($categorie, $title, $description, $src, $alt, $author);
            
		header('location:index.php?page=gestionArticle');
			exit;
	}
		public function displayModify()
	{
	    $model = new \Models\Article();
	    $article = $model -> getArticleById($_GET['id']);
	    $model = new \Models\Category();
	    $categories = $model -> getAllCategory();  
	    $model = new \Models\Author();
	    $authors = $model -> getAllAuthors(); 
        $template = 'views//back-end/modify/modifyArticle.phtml';
        include 'views/layout.phtml';
	}
	
	public function ModifySubmit()
	{
		//préparer les données pour les mettre dans la base de données
		$categories = $_POST['category'];
		$title = $_POST['titre'];
		$description = $_POST['texte'];
		if (empty($_FILES['src']['name'])) {
			$src = $_POST['imgBdd'];
		}
		else {
			$src = "assets/img/{$_FILES['img']['name']}";
			move_uploaded_file ($_FILES['img']['tmp_name'], $src );
		}
		$alt = $_POST['alt'];
		$author = $_POST['author'];
		
		//mettre les datas en bdd
		$model = new \Models\Article();
		$modifyArticle = $model -> ModifyArticle($categories, $title, $description, $src, $alt, $author, $_GET['id']);
            
		header('location:index.php?page=gestionArticle');
			exit;
	}
	

}