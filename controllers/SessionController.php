<?php

namespace Controllers;

Trait SessionController
{
	public function redirectIfNotAdmin()
	{
		if(!isset($_SESSION['admin']))
		{
			header('location:home');
		}
	}
	public function redirectIfNotUser()
	{
		if(!isset($_SESSION['user']))
		{
			header('location:home');
		}
	}
	
	public function sessionCart()
	{
		if(!isset($_SESSION))
        {
            session_start();
        }
        if(!isset($_SESSION['cart']))
        {
            $_SESSION['cart'] = array();
        } 
	}
}