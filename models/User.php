<?php

namespace Models;

class User extends Database
{
	//requête sql qui permet de trouver tous les utilisateurs 
	public function getAllUsers():array
	{
		return $this -> findAll(
			"SELECT email, password, firstname, lastname, phone FROM user"
		);		
	}
	
	public function AddUser($email, $pw, $firstName, $lastName, $phone)
	{
		//requête sql qui permet l'ajout d'un nouvel utilisateur
		$this -> query(
			"INSERT INTO user(email, password, firstname, lastname, phone) VALUES (?,?,?,?,?)",
			[$email, $pw, $firstName, $lastName, $phone]
		);
	}

	public function getUserByEmail($email):?array
	{
		//requête sql qui permet de trouver un utilisateur particulier
		return $this -> findOne(
			"SELECT id, email, password, firstname, lastname, phone FROM user
			WHERE email = ?",
			[$email]
		);
	}
}