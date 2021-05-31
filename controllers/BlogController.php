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
        $template = 'views/blog.phtml';
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
	    $categories = $model1 -> getAllAuthor();
        $template = 'views/addArticle.phtml';
        include 'views/layout.phtml';
	}
	
	public function AddSubmit()
	{
		//préparer les données pour les mettre dans la base de données
		$id_category = $_POST['category'];
		$id_author = $_POST['author'];
		$titre = $_POST['title'];
		$image = "img/blog/{$_FILES['src']['name']}";
		$alt = $_POST['alt'];
		
		//upload mon image
		move_uploaded_file ($_FILES['src']['tmp_name'], $image );
		
		//mettre les datas en bdd
		$model = new \Models\Article();
		$model -> AddArticle($category, $title, $content, $src, $alt, $author);
            
		header('location:index.php?page=gestionArticle');
			exit;
	}
		public function displayModify()
	{
	    $model = new \Models\Article();
	    $meal = $model -> getArticleById($_GET['id_article']);
	    $model = new \Models\Category();
	    $categories = $model -> getAllCategory();  
            $template = 'views/modifyArticle.phtml';
            include 'views/layout.phtml';
	}
	
	public function ModifySubmit()
	{
		//préparer les données pour les mettre dans la base de données
		$titre = $_POST['titre'];
		if (empty($_FILES['src']['name'])) {
			$image = $_POST['imgBdd'];
		}
		else {
			$image = "img/blog/{$_FILES['img']['name']}";
			move_uploaded_file ($_FILES['img']['tmp_name'], $image );
		}
		$alt = $_POST['alt'];
		$id_category = $_POST['category'];
		$id_author = $_POST['author'];
		
		//mettre les datas en bdd
		$model = new \Models\Article();
		$modifyMeal = $model -> ModifyArticle($_GET['id_article'], $category, $title, $content, $src, $alt, $author);
            
		header('location:index.php?page=gestionArticle');
			exit;
	}
	
	

}