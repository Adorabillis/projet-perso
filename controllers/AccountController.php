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
		//afficher le formulaire de connexion
            $template = 'views/userAccount.phtml';
            include 'views/layout.phtml';
	}
}
