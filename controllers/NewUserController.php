<?php

namespace Controllers;

class NewUserController {
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
            $template = 'views/newUser.phtml';
            include 'views/layout_front.phtml';
	}
	public function disconnect()
	{
	    //je déconnecte l'utilisateur
			session_destroy();
			header('location:index.php');
			exit;
	}
	
	//traitement du formulaire
	public function submit()
	{
		//préparer les données pour les mettre dans la base de données
		$firstName = $_POST['firstName'];
		$lastName= $_POST['lastName'];
		$email = $_POST['email'];
		$phone= $_POST['phone'];
		$pw = password_hash($_POST['pw'], PASSWORD_DEFAULT);

		//mettre les datas en bdd
		$model = new \Models\User();
		try {
		$model -> AddUser($email, $pw, $firstName, $lastName, $phone);
		header('location:index.php?page=accueil');
			exit;
		}
		catch(\Exception $e){
			$this -> message1 = "Cet email est déjà utilisé";
		}
	}
	
 
	
	public function IsConnected() 
	{
	    	include 'models/User.php';
			
			$email = $_POST['email'];
			$pw = $_POST['pw'];
			
			//comparer avec ce que j'ai en bdd
			$model = new \Models\User();
			//aller chercher les infos de l'utilisateur/iden qui essaye de se connecter
			$user = $model -> getUserByEmail($email);
			
			//si l'identifiant existe dans la base alors âdmin contiendra les infos de cet admin
			//sinon $admin contiendra false
			
			if(!$user)
			{
				$this -> message1 = "Mauvais identifiant";
			}
			else
			{
				//vérifier le mot de passe
				if(password_verify($pw,$user['password']))
				{
					//le mot de passe correcpond
					//connecter l'utilisateur
					$_SESSION['user'] = $user['firstname'].' '.$user['lastname'];
					//redirige vers la page tableau de bord du backoffice
					header('location:index.php?page=accueil');
					exit;
				}
				else
				{
					$this -> message2 = "Mauvais mot de passe";
				}
			}
	}
	
}

