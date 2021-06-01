<?php

namespace Controllers;

class CategoryController {
	
	use SessionController;
	
	public function __construct()
	{
		$this -> redirectIfNotAdmin();
		//si le formulaire a été soumis
	}

	public function display()
	{
		//afficher les Catégories
		$model = new \Models\Category();
		$categories = $model -> getAllCategory();
        $template = 'views/back-end/gestionCategory.phtml';
        include 'views/layout.phtml';
	}
		public function delete()
	{
		//supprimer une catégorie
	    $model = new \Models\Category();
	    $model -> deleteCategory($_GET['id']);
	}
	public function displayAdd()
	{
	    $model = new \Models\Category();
	    $categories = $model -> getAllCategory();
        $template = 'views/back-end/add/addCategory.phtml';
        include 'views/layout.phtml';
	}
	
	public function AddSubmit()
	{
		//préparer les données pour les mettre dans la base de données
		$nom = $_POST['name'];

		//mettre les datas en bdd
		$model = new \Models\Category();
		$model -> AddCategory($nom);
            
		header('location:index.php?page=gestionCategory');
			exit;
	}
		public function displayModify()
	{
	    $model = new \Models\Category();
	    $category = $model -> findCategoryById($_GET['id']);
	    $model = new \Models\Category();
	    $categories = $model -> getAllCategory();  
        $template = 'views/back-end/modify/modifyCategory.phtml';
        include 'views/layout.phtml';
	}
	
	public function ModifySubmit()
	{
		//préparer les données pour les mettre dans la base de données
		$name = $_POST['name'];
		$id = $_GET['id_category'];
		
		//mettre les datas en bdd
		$model = new \Models\Category();
		$modifyCategory = $model -> ModifyCategory($_GET['id_category'], $nom);
            
		header('location:index.php?page=gestionCategory');
			exit;
	}
}