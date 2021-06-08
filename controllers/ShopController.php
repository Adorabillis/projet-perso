<?php

namespace Controllers;

class ShopController
{
	public function displayAllProducts()
	{
		//afficher les produits dans la boutique
		$model = new \Models\Category();
		$categories = $model -> getAllCategory();
		$model1 = new \Models\Product();
		$products = $model1 -> getAllProducts();
        $template = 'views/shop/shop.phtml';
        include 'views/layout.phtml';
	}
	public function displayProduct()
	{
		//"sécuriser" l'url : si on change l'url elle revient sur accueil
		if(!isset($_GET['id_product']))
		{
			header('location:index.php');
			exit;
		}
		$model = new \Models\Product();
	    $product = $model -> getProductById($_GET['id_product']);
	    $template = 'views/shop/product.phtml';
        include 'views/layout.phtml';
	}
}