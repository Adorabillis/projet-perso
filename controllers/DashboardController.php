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
		$model = new \Models\Order();
		$orders = $model -> getAllOrder();
		//afficher le formulaire de connexion
            $template = 'back-end/dashboard.phtml';
            include 'views/layout.phtml';
	}
	
	
	
}
