<?php

namespace Controllers;

class ProductController {
	
	use SessionController;
	
	public function __construct()
	{
		$this -> redirectIfNotAdmin();
		//si le formulaire a été soumis
	}

	public function display()
	{
		//afficher les produits sur le back-office
		$model = new \Models\Category();
		$categories = $model -> getAllCategory();
		$model1 = new \Models\Product();
		$products = $model1 -> getAllProducts();
        $template = 'views/back-end/gestionProduct.phtml';
        include 'views/layout.phtml';
	}
	
		public function delete()
	{
	    $model = new \Models\Product();
	    $model -> deleteProduct($_GET['id_product']);
	}
	public function displayAdd()
	{
	    $model = new \Models\Category();
	    $categories = $model -> getAllCategory();
        $template = 'views/back-end/add/addProduct.phtml';
        include 'views/layout.phtml';
	}
	
	public function AddSubmit()
	{
		//préparer les données pour les mettre dans la base de données
		$name = $_POST['productname'];
		$description = $_POST['texte'];
		$prix = $_POST['price'];
		$categorie = $_POST['category'];
		$quantite = $_POST['stock'];
		$src = "assets/img/{$_FILES['src']['name']}";
		$alt = $_POST['alt'];
		
		//upload mon image
		move_uploaded_file ($_FILES['src']['tmp_name'], $src);
		
		//mettre les datas en bdd
		$model = new \Models\Product();
		$model -> AddProduct($name, $description, $prix, $categorie, $quantite, $src, $alt);
            
		header('location:index.php?page=gestionProduct');
			exit;
	}
		public function displayModify()
	{
	    $model = new \Models\Product();
	    $product = $model -> getProductById($_GET['id']);
	    $model = new \Models\Category();
	    $categories = $model -> getAllCategory();  
        $template = 'views//back-end/modify/modifyProduct.phtml';
        include 'views/layout.phtml';
	}
	
	public function ModifySubmit()
	{
		//préparer les données pour les mettre dans la base de données
		$name = $_POST['productname'];
		$description = $_POST['texte'];
		$prix = $_POST['price'];
		$categories = $_POST['category'];
		$quantite = $_POST['stock'];
		if (empty($_FILES['src']['name'])) {
			$src = $_POST['imgBdd'];
		}
		else {
			$src = "assets/img/{$_FILES['img']['name']}";
			move_uploaded_file ($_FILES['img']['tmp_name'], $src );
		}
		$alt = $_POST['alt'];
		
		//mettre les datas en bdd
		$model = new \Models\Product();
		$modifyProduct = $model -> ModifyProduct($name, $description, $prix, $categories, $quantite, $src, $alt, $_GET['id']);
            
		header('location:index.php?page=gestionProduct');
			exit;
	}
}