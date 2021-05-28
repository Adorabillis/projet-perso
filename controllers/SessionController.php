<?php

namespace Controllers;

Trait SessionController
{
	public function redirectIfNotAdmin()
	{
		if(!isset($_SESSION['admin']))
		{
			header('location:accueil');
		}
	}
	public function redirectIfNotUser()
	{
		if(!isset($_SESSION['user']))
		{
			header('location:accueil');
		}
	}
}