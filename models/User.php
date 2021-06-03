<?php

namespace Models;

class User extends Database
{
	//requête sql qui permet de trouver tous les utilisateurs 
	public function getAllUsers():array
	{
		return $this -> findAll(
			"SELECT email, password, first_name, last_name, phone, adress_line1, adress_line2, postal_code, city, country FROM user"
		);		
	}
	
	public function AddUser($email, $pw, $firstName, $lastName, $phone, $address1, $address2, $codepostal, $city, $country)
	{
		//requête sql qui permet l'ajout d'un nouvel utilisateur
		$this -> query(
			"INSERT INTO user(email, password, first_name, last_name, phone, adress_line1, adress_line2, postal_code, city, country) VALUES (?,?,?,?,?,?,?,?,?,?)",
			[$email, $pw, $firstName, $lastName, $phone, $address1, $address2, $codepostal, $city, $country]
		);
	}

	public function getUserByEmail($email):?array
	{
		//requête sql qui permet de trouver un utilisateur particulier
		return $this -> findOne(
			"SELECT id, email, password, first_name, last_name, phone, adress_line1, adress_line2, postal_code, city, country FROM user
			WHERE email = ?",
			[$email]
		);
	}
}