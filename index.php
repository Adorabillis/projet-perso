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
			$controller = new Controllers\ContactController();
			$controller -> display();
			break;
		case 'about':
			//include 'controllers/AdminController.php';
			$controller = new Controllers\AdminController();
			$controller -> display();
			break;
		case 'dashboard':
			//include 'controllers/TableauDeBordController.php';
			$controller = new Controllers\TableauDeBordController();
			$controller -> display();
			break;
		case 'createMeal':
			$controller = new Controllers\MealController();
			//si le formulaire a été soumis
			if(!empty($_POST))
			{
				$controller -> AddSubmit();
			}
			else {
				$controller -> displayAdd();	
			}
			break;
		case 'modifyMeal':
			$controller = new Controllers\MealController();
			//si le formulaire a été soumis
			if(!empty($_POST))
			{
				$controller -> ModifySubmit();
			}
			else {
				$controller -> displayModify();	
			}
			break;
		case 'deleteMeal':
			$controller = new Controllers\MealController();
			$controller -> delete();
			break;
		case 'slider':
			$controller = new Controllers\SliderController();
			$controller -> display();
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