<?php

namespace Controllers;

class MealController {
	
	use SessionController;
	
	public function __construct()
	{
		$this -> redirectIfNotAdmin();
		//si le formulaire a été soumis
	
	}

	public function display()
	{
		//afficher les plats
		$model = new \Models\Meal();
		$meals = $model -> getAllMeals();
		$model = new \Models\Category();
		$categories = $model -> getAllCategory();
            $template = 'views/meal.phtml';
            include 'views/layout_front.phtml';
	}
		public function delete()
	{
	    $model = new \Models\Meal();
	    $model -> deleteMeal($_GET['id']);
	}
	public function displayAdd()
	{
	    $model = new \Models\Category();
	    $categories = $model -> getAllCategory();
            $template = 'views/addMeal.phtml';
            include 'views/layout_front.phtml';
	}
	
	public function AddSubmit()
	{
		//préparer les données pour les mettre dans la base de données
		$nom = $_POST['name'];
		$image = "img/menus/{$_FILES['img']['name']}";
		$alt = $_POST['alt'];
		$id_category = $_POST['category'];
		
		//upload mon image
		move_uploaded_file ($_FILES['img']['tmp_name'], $image );
		
		//mettre les datas en bdd
		$model = new \Models\Meal();
		$model -> AddMeal($nom, $image, $alt, $id_category);
            
		header('location:index.php?page=meal');
			exit;
	}
		public function displayModify()
	{
	    $model = new \Models\Meal();
	    $meal = $model -> findMealById($_GET['id']);
	    $model = new \Models\Category();
	    $categories = $model -> getAllCategory();  
            $template = 'views/modifyMeal.phtml';
            include 'views/layout_front.phtml';
	}
	
	public function ModifySubmit()
	{
		//préparer les données pour les mettre dans la base de données
		$nom = $_POST['name'];
		if (empty($_FILES['img']['name'])) {
			$image = $_POST['imgBdd'];
		}
		else {
			$image = "img/menus/{$_FILES['img']['name']}";
			move_uploaded_file ($_FILES['img']['tmp_name'], $image );
		}
		$alt = $_POST['alt'];
		$id_category = $_POST['category'];
		
		//mettre les datas en bdd
		$model = new \Models\Meal();
		$modifyMeal = $model -> ModifyMeal($_GET['id'], $nom, $image, $alt, $id_category);
            
		header('location:index.php?page=meal');
			exit;
	}
	
	

}