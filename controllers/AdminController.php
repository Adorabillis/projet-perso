<?php

namespace Controllers;

class AdminController 
{
    private $message1;
    private $message2;
    
    public function __construct()
    {
        $this -> message1 = "";
        $this -> message2 = "";
        if(!empty($_POST))
		{
		    $this -> submit();
		
	    }
	    if(isset($_GET['action']) && $_GET['action'] == 'deco')
		{
			$this -> disconnect();
		}
    }
    
	public function display()
	{
		//afficher le formulaire de connexion
            $template = 'views/back-end/admin.phtml';
            include 'views/layout.phtml';
	}
	public function disconnect()
	{
	    //je déconnecte l'utilisateur
			session_destroy();
			header('location:index.php');
			exit;
	}
	public function submit() 
	{
	    include 'models/Admin.php';
		
		$login = $_POST['login'];
		$pw = $_POST['pw'];
		
		//comparer avec ce que j'ai en bdd
		$model = new \Models\Admin();
		//aller chercher les infos de l'utilisateur/iden qui essaye dese connecter
		$admin = $model -> getAdminByLogin($login);
		
		
		//si l'identifiant existe dans la base alors âdmin contiendrales infos de cet admin
		//sinon $admin contiendra false
		
		if(!$admin)
		{
			$this -> message1 = "Mauvais identifiant";
		}
		else
		{
			//vérifier le mot de passe
			if(password_verify($pw,$admin['password']))
			{
				//le mot de passe correcpond
				//connecter l'utilisateur
				$_SESSION['admin'] = $admin['prenom'].' '.$admin['nom'];
				//redirige vers la page tableau de bord du backoffice
				header('location:index.php?page=dashboard');
				exit;
			}
			else
			{
				$this -> message2 = "Mauvais mot de passe";
			}
		}
	}	
}


