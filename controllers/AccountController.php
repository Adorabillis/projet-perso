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
		$id = $_SESSION['id_user'];
		
		$model = new \Models\Users();
	    $users = $model -> getUserById($id);
		
		//afficher le formulaire de connexion
            $template = 'views/userAccount.phtml';
            include 'views/layout.phtml';
	}
}
