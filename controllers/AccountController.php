<?php

namespace Controllers;

class AccountController 
{
	
	use SessionController;
	
		public function __construct()
	{
		$this -> redirectIfNotUser();
	}
	
	public function display()
	{
		$id = $_SESSION['idUser'];
		var_dump($id);
		
		$model = new \Models\User();
	    $users = $model -> getUserById($id);
		
		//afficher le formulaire de connexion
            $template = 'views/userAccount.phtml';
            include 'views/layout.phtml';
	}
}
