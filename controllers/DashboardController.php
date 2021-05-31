<?php

namespace Controllers;

class DashboardController 
{
	
	use SessionController;
	
		public function __construct()
	{
		$this -> redirectIfNotAdmin();
	}
	
	public function display()
	{
		
		
		//afficher le formulaire de connexion
		
            $template = 'back-end/dashboard.phtml';
            include 'views/layout.phtml';
	}
}
