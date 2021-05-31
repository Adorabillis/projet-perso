<?php

//setcookie('user_id', '1234');
//setcookie('user_pref', 'dark_theme', time()+3600*24*30, '/', '', true, true);

//démarrer le système de session
session_start();

//autoloader
spl_autoload_register(function($class){	
	include str_replace('\\','/',lcfirst($class)).".php";	
});

//si je n'ai pas un paramètre page
if(!isset($_GET['page']))
{
	//lancer la page d'accueil
	$controller = new Controllers\AccueilController();
	$controller -> display();
}
else
{
	switch($_GET['page'])
	{
		case 'home':
			$controller = new Controllers\AccueilController();
			$controller -> display();
			break;
		case 'jeu':
			$controller = new Controllers\GameController();
			$controller -> display();
			break;
		case 'merch':
			$controller = new Controllers\MerchController();
			$controller -> display();
			break;
		case 'about':
			$controller = new Controllers\AboutController();
			$controller -> display();
			break;
		case 'admin':
				$controller = new Controllers\AdminController();
				$controller -> display();
				break;
		case 'dashboard':
			$controller = new Controllers\DashboardController();
			$controller -> display();
			break;
		case 'gestionArticle':
			$controller = new Controllers\BlogController();
			$controller -> display();
			break;
		case 'addArticle':
			$controller = new Controllers\BlogController();
			//si le formulaire a été soumis
			if(!empty($_POST))
			{
				$controller -> AddSubmit();
			}
			else {
				$controller -> displayAdd();	
			}
			break;
		case 'modifyArticle':
			$controller = new Controllers\BlogController();
			//si le formulaire a été soumis
			if(!empty($_POST))
			{
				$controller -> ModifySubmit();
			}
			else {
				$controller -> displayModify();	
			}
			break;
		case 'deleteArticle':
			$controller = new Controllers\BlogController();
			$controller -> delete();
			break;
		case 'gestionCategory':
			$controller = new Controllers\CategoryController();
			$controller -> display();
			break;
		case 'addCategory':
			$controller = new Controllers\CategoryController();
			//si le formulaire a été soumis
			if(!empty($_POST))
			{
				$controller -> AddSubmit();
			}
			else {
				$controller -> displayAdd();	
			}
			break;
		case 'modifyCategory':
			$controller = new Controllers\CategoryController();
			//si le formulaire a été soumis
			if(!empty($_POST))
			{
				$controller -> ModifySubmit();
			}
			else {
				$controller -> displayModify();	
			}
			break;
		case 'deleteCategory':
			$controller = new Controllers\CategoryController();
			$controller -> delete();
			break;
		case 'gestionAuthor':
			$controller = new Controllers\AuthorController();
			$controller -> display();
			break;
		case 'addAuthor':
			$controller = new Controllers\AuthorController();
			//si le formulaire a été soumis
			if(!empty($_POST))
			{
				$controller -> AddSubmit();
			}
			else {
				$controller -> displayAdd();	
			}
			break;
		case 'modifyAuthor':
			$controller = new Controllers\AuthorController();
			//si le formulaire a été soumis
			if(!empty($_POST))
			{
				$controller -> ModifySubmit();
			}
			else {
				$controller -> displayModify();	
			}
			break;
		case 'deleteAuthor':
			$controller = new Controllers\AuthorController();
			$controller -> delete();
			break;
		case 'connexion':
			//include 'controllers/AdminController.php';
			$controller = new Controllers\ConnexionController();
			$controller -> display();
			break;
		case 'newUser':
			//include 'controllers/AdminController.php';
			$controller = new Controllers\NewUserController();
			$controller -> display();
			break;

		case 'cookie':
			//include 'controllers/AdminController.php';
			$controller = new Controllers\CookieController();
			$controller -> createCookie();
			break;
	}

}