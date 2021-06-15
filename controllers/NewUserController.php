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
            include 'views/layout.phtml';
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
		if (isset( $_POST['firstName']) && !empty($_POST['firstName']) && isset( $_POST['lastName']) && !empty($_POST['lastName']) && isset( $_POST['phone']) && !empty($_POST['phone']) && isset( $_POST['address1']) && !empty($_POST['address1']) &&isset( $_POST['codepostal']) &&  !empty($_POST['codepostal']) && isset( $_POST['city']) && !empty($_POST['city']) && isset( $_POST['country']) && !empty($_POST['country']) && isset( $_POST['email']) && !empty($_POST['email']) && isset( $_POST['pw']) && !empty($_POST['pw']))
		{
			//préparer les données pour les mettre dans la base de données
			$firstName = $_POST['firstName'];
			$lastName = $_POST['lastName'];
			$phone= $_POST['phone'];
			$address1 = $_POST['address1'];
			$address2 = $_POST['address2'];
			$codepostal = $_POST['codepostal'];
			$city = $_POST['city'];
			$country = $_POST['country'];
			$email = $_POST['email'];
			$pw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
	
			//mettre les datas en bdd
			$model = new \Models\User();
			try 
			{
			$model -> AddUser($email, $pw, $firstName, $lastName, $phone, $address1, $address2, $codepostal, $city, $country);
			//header('location:index.php?page=home');
			//	exit;
			}
			catch(\Exception $e)
			{
				$this -> message1 = "Cet email est déjà utilisé";
			}
			
		}
			$user = $model -> getUserByEmail($email);
			
			$_SESSION['id_user'] = $user['id_user'];
		
			header('location:index.php?page=account');
			exit;
	}
	
//	public function IsConnected() 
//	{
//	    	include 'models/User.php';
//			
//			$email = $_POST['email'];
//			$pw = $_POST['pw'];
//			
//			//comparer avec ce que j'ai en bdd
//			$model = new \Models\User();
//			//aller chercher les infos de l'utilisateur/iden qui essaye de se connecter
//			$user = $model -> getUserByEmail($email);
//			
//			//si l'identifiant existe dans la base alors âdmin contiendra les infos de cet admin
//			//sinon $user contiendra false
//			
//			if(!$user)
//			{
//				$this -> message1 = "Mauvais identifiant";
//			}
//			else
//			{
//				//vérifier le mot de passe
//				if(password_verify($pw,$user['password']))
//				{
//					//le mot de passe correcpond
//					//connecter l'utilisateur
//					$_SESSION['user'] = $user['firstname'].' '.$user['lastname'];
//					//redirige vers la page tableau de bord du backoffice
//					header('location:index.php?page=home');
//					exit;
//				}
//				else
//				{
//					$this -> message2 = "Mauvais mot de passe";
//				}
//			}
//	}
}